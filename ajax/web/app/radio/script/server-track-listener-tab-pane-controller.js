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
	#trackSources;
	#tracks;


	/**
	 * Initializes a new instance.
	 */
	constructor () {
		super("button.server-track-listener");
		this.#trackSources = [];
		this.#tracks = [];

		// register controller event listeners 
		this.addEventListener("activated", event => this.processActivated());
		this.addEventListener("deactivated", event => this.processDeactivated());
	}


	// getter/setter operations
	get audioMixer () { return this.sharedProperties["audio-context"]; }

	get tracksQuerySection () { return this.center.querySelector("section.server-tracks-query"); }
	get tracksQueryButton () { return this.tracksQuerySection.querySelector("div.control>button.query"); }
	get tracksQueryArtistSelector () { return this.tracksQuerySection.querySelector("div.criteria>span.artist>select"); }
	get tracksQueryGenreSelector () { return this.tracksQuerySection.querySelector("div.criteria>span.genre>select"); }
	get tracksQueryControlSpan () { return this.tracksQuerySection.querySelector("div.criteria>span.control"); }
	get tracksQueryMasterVolumeInput () { return this.tracksQueryControlSpan.querySelector("input.volume"); }
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
			await this.audioMixer.audioWorklet.addModule("../../../share/audio-processors.js");

			// register basic event listeners
			this.tracksQueryButton.addEventListener("click", event => this.processQueryMatchingTracks());

			// asynchronously start playback loop
			this.#periodicallyScheduleTrackPlayback(10);

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
			for (const trackSource of this.#trackSources) {
				trackSource.stop();
				trackSource.disconnect();
			}

			this.#trackSources.length = 0;
			this.#tracks.length = 0;
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
	 * @param period the repetition period in seconds
	 */
	async #periodicallyScheduleTrackPlayback (period) {
		// TODO
	}


	/**
	 * Expands the playlist with tracks matching the selected search criteria.
	 */
	async processQueryMatchingTracks () {
		// TODO
	}
}