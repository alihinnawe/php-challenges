import TabPaneController from "../../../share/tab-pane-controller.js";
import RADIO_SERVICE from "../../../share/radio-service.js";
import RapidGeniusLyricsServiceProxy from "../../../share/rapid-genius-lyrics-service.js";
import ELEMENT_FACTORY from "../../../share/element-factory.js";
import IntegerMath from "../../../share/integer-math.js";
import { sleep } from "../../../share/threads.js";


// constants
const RAPID_GENIUS_LYRICS_SERVICE = new RapidGeniusLyricsServiceProxy("6b614363a0mshbbd38a963ab23c6p1eaf6djsn05c146e77155");
const SECOND_MILLIES = 1000;
const QUERY_TRACKS_LIMIT = 50;


/**
 * Server track listener tab pane controller type.
 */
class ServerTrackListenerTabPaneController extends TabPaneController {
	#tracks;
	#trackSamplers;
	#trackRecordings;
	#crossfadeDuration;


	/**
	 * Initializes a new instance.
	 */
	constructor () {
		super("button.server-track-listener");
		this.#tracks = [];
		this.#trackRecordings = [];
		this.#trackSamplers = [];
		this.#crossfadeDuration = 0;

		// register controller event listeners 
		this.addEventListener("activated", event => this.processActivated());
		this.addEventListener("deactivated", event => this.processDeactivated());
	}


	// getter/setter operations
	get audioContext () { return this.sharedProperties["audio-context"]; }

	get tracksQuerySection () { return this.center.querySelector("section.server-tracks-query"); }
	get tracksQueryButton () { return this.tracksQuerySection.querySelector("div.control>button.query"); }
	get tracksQueryGenreSelector () { return this.tracksQuerySection.querySelector("div.criteria>span.genre>select"); }
	get tracksQueryArtistSelector () { return this.tracksQuerySection.querySelector("div.criteria>span.artist>select"); }
	get tracksQueryControlSpan () { return this.tracksQuerySection.querySelector("div.criteria>span.control"); }
	get tracksQueryVolumeInput () { return this.tracksQueryControlSpan.querySelector("input.volume"); }
	get tracksQueryCompressionRatioInput () { return this.tracksQueryControlSpan.querySelector("input.compression-ratio"); }
	get tracksQueryCrossfadeDurationInput () { return this.tracksQueryControlSpan.querySelector("input.crossfade"); }

	get trackPlaylistSection () { return this.center.querySelector("section.server-track-playlist"); }
	get trackPlaylistTableBody () { return this.trackPlaylistSection.querySelector("span.tracks>div>table>tbody"); }
	get trackPlaylistLyricsDivision () { return this.trackPlaylistSection.querySelector("span.lyrics>div"); }


	/**
	 * Handles that activity has changed from false to true.
	 */
	async processActivated () {
		try {
			// redefine center content
			while (this.center.lastElementChild) this.center.lastElementChild.remove();
			const tracksQuerySectionTemplate = await this.queryTemplate("server-tracks-query");
			this.center.append(tracksQuerySectionTemplate.content.firstElementChild.cloneNode(true));

			// initialize audio system components
			await this.audioContext.audioWorklet.addModule("../../../share/audio-processors.js");

			// register basic event listeners
			this.tracksQueryButton.addEventListener("click", event => this.processQueryMatchingTracks());
			this.tracksQueryCrossfadeDurationInput.addEventListener("input", event => this.#crossfadeDuration = window.parseFloat(event.currentTarget.value.trim()));
			this.tracksQueryCrossfadeDurationInput.dispatchEvent(new InputEvent("input"));

			// asynchronously start playback loop
			this.#periodicallyQueryAndDecodeTrackRecording();
			this.#periodicallyScheduleTrackPlayback();

			const genresAndArtists = await Promise.all([ RADIO_SERVICE.queryTrackGenres(), RADIO_SERVICE.queryTrackArtists() ]);
			for (const genre of genresAndArtists[0])
				this.tracksQueryGenreSelector.append(ELEMENT_FACTORY.createHtmlElement("option", { value: genre, innerText: genre }));
			for (const artist of genresAndArtists[1])
				this.tracksQueryArtistSelector.append(ELEMENT_FACTORY.createHtmlElement("option", { value: artist, innerText: artist }));

			this.messageOutput.value = "";
		} catch (error) {
			this.messageOutput.value = error.toString();
			console.error(error);
		}
	}


	/**
	 * Handles that activity has changed from true to false.
	 */
	processDeactivated () {
		try {
			for (const trackSampler of this.#trackSamplers) {
				try {
					trackSampler.stop();
				} catch (error) {
					// do nothing
				}
				trackSampler.disconnect();
			}

			this.#trackRecordings.length = 0;
			this.#tracks.length = 0;
		} catch (error) {
			this.messageOutput.value = error.toString();
			console.error(error);
		}
	}


	/**
	 *
	 */
	async #periodicallyQueryAndDecodeTrackRecording () {
		try {
			while (this.active) {
				if (this.#tracks.length > 0 && this.#trackRecordings.length < 5) {
					const track = this.#tracks.shift();

					const trackBuffer = await RADIO_SERVICE.findDocument(track.attributes["recording-reference"], false);
					const trackRecording = await this.audioContext.decodeAudioData(trackBuffer);
					if (!this.active) continue;

					this.#trackRecordings.push(trackRecording);
				}

				await sleep(1 * SECOND_MILLIES);
			}
		} catch (error) {
			this.messageOutput.value = error.toString();
			console.error(error);
		}
	}


	/**
	 * Continuously scans the track playlist asynchronously to perform track playback.
	 * Note that this design defining an asynchronous method performing a loop catching
	 * any errors while active, and subsequently calling setTimeout(), avoids two mayor
	 * pitfalls compared to using setInterval(): No continued scheduling while inactive,
	 * and no overlapping calls of methods running longer than the repetition period!
	 */
	async #periodicallyScheduleTrackPlayback () {
		try {
			let fadeOutGainNode = null;
			let fadeInGainNode = null;

			while (this.active) {
				if (this.#trackRecordings.length > 0 && this.#trackSamplers.length < 2) {
					const trackSampler = new AudioBufferSourceNode(this.audioContext);
					trackSampler.buffer = this.#trackRecordings.shift();

					const companderNode = new AudioWorkletNode(this.audioContext, "compander-processor");
					this.tracksQueryCompressionRatioInput.addEventListener("input", event => companderNode.parameters.get("ratio").value = 2 ** window.parseFloat(event.currentTarget.value.trim()));
					this.tracksQueryCompressionRatioInput.dispatchEvent(new InputEvent("input"));

					const volumeNode = new GainNode(this.audioContext);
					this.tracksQueryVolumeInput.addEventListener("input", event => volumeNode.gain.value = window.parseFloat(event.currentTarget.value.trim()));
					this.tracksQueryVolumeInput.dispatchEvent(new InputEvent("input"));
					
					fadeOutGainNode = fadeInGainNode;
					fadeInGainNode = new GainNode(this.audioContext);
					fadeInGainNode.gain.value = 2 - this.#trackSamplers.length;
					
					trackSampler.connect(companderNode);
					companderNode.connect(volumeNode);
					volumeNode.connect(fadeInGainNode);
					fadeInGainNode.connect(this.audioContext.destination);

					trackSampler.addEventListener("ended", event => {
						if (!this.active) return;
						this.#trackSamplers.shift().disconnect();
						this.trackPlaylistTableBody.firstElementChild.remove();
					});

					trackSampler.start(this.audioContext.currentTime);
					if (this.#trackSamplers.length == 2) {
						fadeOutGainNode.gain.linearRampToValueAtTime(fadeOutNode.gain.value, this.audioContext.currentTime);
						fadeInGainNode.gain.linearRampToValueAtTime(fadeInNode.gain.value, this.audioContext.currentTime);
						fadeOutGainNode.gain.linearRampToValueAtTime(0, this.audioContext.currentTime + this.#crossfadeDuration);
						fadeInGainNode.gain.linearRampToValueAtTime(1, this.audioContext.currentTime + this.#crossfadeDuration);
					};
					this.#trackSamplers.push(trackSampler);

					const durationText = Math.floor(trackSampler.buffer.duration / 60).toString() + ":" + Math.round(trackSampler.buffer.duration % 60).toString();
					this.trackPlaylistTableBody.querySelector("tr:nth-of-type(" + this.#trackSamplers.length + ")>td.duration").innerText = durationText;

					await sleep(Math.round(Math.max(trackSampler.buffer.duration - this.#crossfadeDuration, 0) * SECOND_MILLIES));
				} else {
					await sleep(1 * SECOND_MILLIES);
				}
			}
		} catch (error) {
			this.messageOutput.value = error.toString();
			console.error(error);
		}
	}


	/**
	 * Expands the playlist with tracks matching the selected search criteria.
	 */
	async processQueryMatchingTracks () {
		try {
			const genres = Array.from(this.tracksQueryGenreSelector.selectedOptions).map(option => option.value);
			const artists = Array.from(this.tracksQueryArtistSelector.selectedOptions).map(option => option.value);
			const tracks = await RADIO_SERVICE.queryTracks(null, QUERY_TRACKS_LIMIT, null, null, null, null, null, null, artists, [], genres, true);
			console.log(tracks);

			if (!this.trackPlaylistSection) {
				const trackPlaylistSectionTemplate = await this.queryTemplate("server-track-playlist");
				this.center.append(trackPlaylistSectionTemplate.content.firstElementChild.cloneNode(true));
			}

			const tableRowTemplate = await this.queryTemplate("server-track-playlist-row");
			for (const track of tracks) {
				this.#tracks.push(track);
	
				const tableRow = tableRowTemplate.content.firstElementChild.cloneNode(true);
				this.trackPlaylistTableBody.append(tableRow);
	
				tableRow.querySelector("td.cover>img").src = RADIO_SERVICE.documentsURI + "/" + track.attributes["album-cover-reference"];
				tableRow.querySelector("td.artist").innerText = track.artist;
				tableRow.querySelector("td.title").innerText = track.title;
			}

			this.messageOutput.value = "";
		} catch (error) {
			this.messageOutput.value = error.toString();
			console.error(error);
		}
	}
}


/*
 * Registers an event handler for the browser window's load event.
 */
window.addEventListener("load", event => {
	const controller = new ServerTrackListenerTabPaneController();
	console.log(controller);
});
