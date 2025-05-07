import TabPaneController from "../../../share/tab-pane-controller.js";
import RADIO_SERVICE from "../../../share/radio-service.js";


/**
 * Server album editor tab pane controller type.
 */
class ServerAlbumEditorTabPaneController extends TabPaneController {

	/**
	 * Initializes a new instance.
	 */
	constructor () {
		super("button.server-album-editor");

		// register controller event listeners 
		this.addEventListener("activated", event => this.processActivated());
	}


	// getter/setter operations
	get sessionOwner () { return this.sharedProperties["session-owner"]; }

	get albumsViewerSection () { return this.center.querySelector("section.server-albums-viewer"); }
	get albumsViewerTableBody () { return this.albumsViewerSection.querySelector("div.albums>div>table>tbody"); }
	get albumsViewerCreateButton () { return this.albumsViewerSection.querySelector("div.control>button.create"); }

	get albumEditorSection () { return this.center.querySelector("section.server-album-editor"); }
	get albumEditorAlbumDivision () { return this.albumEditorSection.querySelector("div.album"); }
	get albumEditorCoverButton () { return this.albumEditorAlbumDivision.querySelector("span.left>button"); }
	get albumEditorCoverViewer () { return this.albumEditorCoverButton.querySelector("img"); }
	get albumEditorCoverChooser () { return this.albumEditorAlbumDivision.querySelector("span.left>input"); }
	get albumEditorTitleInput () { return this.albumEditorAlbumDivision.querySelector("span.right>div.title>input"); }
	get albumEditorReleaseYearInput () { return this.albumEditorAlbumDivision.querySelector("span.right>div.release-year>input"); }
	get albumEditorTrackTotalInput () { return this.albumEditorAlbumDivision.querySelector("span.right>div.track-total>input"); }
	get albumEditorTracksDivision () { return this.albumEditorSection.querySelector("div.tracks"); }
	get albumEditorTracksTableBody () { return this.albumEditorTracksDivision.querySelector("table>tbody"); }
	get albumEditorTracksCreateButton () { return this.albumEditorTracksDivision.querySelector("div.control>button.create"); }
	get albumEditorSubmitButton () { return this.albumEditorSection.querySelector("div.control>button.submit"); }
	get albumEditorDeleteButton () { return this.albumEditorSection.querySelector("div.control>button.delete"); }
	get albumEditorCancelButton () { return this.albumEditorSection.querySelector("div.control>button.cancel"); }


	/**
	 * Handles that activity has changed from false to true.
	 */
	async processActivated () {
		try {
			// redefine center content
			while (this.center.lastElementChild) this.center.lastElementChild.remove();
			const albumsViewerSectionTemplate = await this.queryTemplate("server-albums-viewer");
			this.center.append(albumsViewerSectionTemplate.content.firstElementChild.cloneNode(true));

			// register basic event listeners
			this.albumsViewerCreateButton.addEventListener("click", event => this.processDisplayAlbumEditor());

			await this.#displayAllAlbums();

			this.messageOutput.value = "";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Queries and displays all persistent albums.
	 */
	async #displayAllAlbums () {
		const albums = await RADIO_SERVICE.queryAlbums();
		// console.log(albums);

		this.albumsViewerTableBody.innerHTML = "";
		const albumsViewerTableRowTemplate = await this.queryTemplate("server-albums-viewer-row");
		for (const album of albums) {
			const tableRow = albumsViewerTableRowTemplate.content.firstElementChild.cloneNode(true);
			this.albumsViewerTableBody.append(tableRow);

			const accessButton = tableRow.querySelector("td.access>button");
			const accessViewer = accessButton.querySelector("img");
			const artistItem = tableRow.querySelector("td.artist");
			const titleItem = tableRow.querySelector("td.title");
			const genreItem = tableRow.querySelector("td.genre");
			const releaseYearItem = tableRow.querySelector("td.release-year");
			const trackTotalItem = tableRow.querySelector("td.track-total");

			accessButton.addEventListener("click", event => this.processDisplayAlbumEditor(album));
			accessViewer.src = RADIO_SERVICE.documentsURI + "/" + album.attributes["cover-reference"];
			artistItem.innerText = album.attributes["artist"] || "-";
			titleItem.innerText = album.title || "-";
			genreItem.innerText = album.attributes["genre"] || "-";
			releaseYearItem.innerText = album.releaseYear.toString();
			trackTotalItem.innerText = album.attributes["track-count"] + "/" + album.trackTotal;
		}
	}


	/**
	 * Displays the given album in a new editor section.
	 * @param album the album, or a new object for none
	 */
	async processDisplayAlbumEditor (album = {}) {
		try {
			if (!album.attributes) album.attributes = { "cover-reference": 1, "author-reference": this.sessionOwner.identity };

			this.albumsViewerSection.classList.add("hidden");
			if (!this.albumEditorSection) {
				const albumEditorSectionTemplate = await this.queryTemplate("server-album-editor");
				this.center.append(albumEditorSectionTemplate.content.firstElementChild.cloneNode(true));
			}

			this.albumEditorCoverViewer.src = RADIO_SERVICE.documentsURI + "/" + album.attributes["cover-reference"];
			this.albumEditorTitleInput.value = album.title || "";
			this.albumEditorReleaseYearInput.value = (album.releaseYear || new Date().getFullYear()).toString();
			this.albumEditorTrackTotalInput.value = (album.trackTotal || 0).toString();

			this.albumEditorCancelButton.addEventListener("click", event => this.processCancel());
			this.albumEditorTracksCreateButton.addEventListener("click", event => this.processDisplayTrackEditor(album.identity));

			if (album.attributes["author-reference"] === this.sessionOwner.identity || this.sessionOwner.group === "ADMIN") {
				this.albumEditorCoverButton.addEventListener("click", event => this.albumEditorCoverChooser.click());
				this.albumEditorCoverViewer.addEventListener("dragover", event => this.processCoverTransferValidation(event.dataTransfer));
				this.albumEditorCoverViewer.addEventListener("drop", event => this.processSubmitAlbumCover(album, event.dataTransfer.files[0]));
				this.albumEditorCoverChooser.addEventListener("change", event => this.processSubmitAlbumCover(album, event.currentTarget.files[0]));
				this.albumEditorSubmitButton.addEventListener("click", event => this.processSubmitAlbum(album));
				this.albumEditorDeleteButton.addEventListener("click", event => this.processDeleteAlbum(album.identity));
			} else {
				this.albumEditorCoverButton.disabled = true;
				this.albumEditorSubmitButton.disabled = true;
				this.albumEditorDeleteButton.disabled = true;
			}

			if (album.identity) {
				const tracks = await RADIO_SERVICE.queryAlbumTracks(album.identity);
				for (const track of tracks) this.processDisplayTrackEditor(album.identity, track);
			} else {
				this.albumEditorTracksDivision.classList.add("hidden");
			}

			this.messageOutput.value = "ok.";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Validates the given data transfer, solely allowing drops of image files.
	 * @param dataTransfer the image transfer
	 */
	async processCoverTransferValidation (dataTransfer) {
		const primaryItem = dataTransfer.items[0];
		dataTransfer.dropEffect = primaryItem.kind === "file" && primaryItem.type && primaryItem.type.startsWith("image/") ? "copy" : "none";
	}


	/**
	 * Submits the given cover file, and registers it as the given album's cover.
	 * @param album the album
	 * @param coverFile the cover image file
	 */
	async processSubmitAlbumCover (album, coverFile) {
		try {
			if (!coverFile.type || !coverFile.type.startsWith("image/")) throw new RangeError();
			album.attributes["cover-reference"] = await RADIO_SERVICE.insertOrUpdateDocument(coverFile);
			this.albumEditorCoverViewer.src = RADIO_SERVICE.documentsURI + "/" + album.attributes["cover-reference"];

			this.messageOutput.value = "ok.";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Submits the given album.
	 * @param album the album
	 */
	async processSubmitAlbum (album) {
		try {
			album.title = this.albumEditorTitleInput.value.trim() || null;
			album.releaseYear = window.parseInt(this.albumEditorReleaseYearInput.value.trim()) || new Date().getFullYear();
			album.trackTotal =  window.parseInt(this.albumEditorTrackTotalInput.value.trim()) || 0;

			album.identity = await RADIO_SERVICE.insertOrUpdateAlbum(album);
			album.version = (album.version || 0) + 1;

			this.albumEditorTracksDivision.classList.remove("hidden");
			this.messageOutput.value = "ok.";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Deletes the given album.
	 * @param albumIdentity the album identity
	 */
	async processDeleteAlbum (albumIdentity) {
		try {
			if (albumIdentity)
				await RADIO_SERVICE.deleteAlbum(albumIdentity);

			this.messageOutput.value = "ok.";
			this.albumEditorCancelButton.click();
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Displays the table row editor for the given track of the given album.
	 * @param albumIdentity the album identity
	 * @param track the track, or a new object for none
	 */
	async processDisplayTrackEditor (albumIdentity, track = {}) {
		try {
			if (!track.attributes) track.attributes = { "author-reference": this.sessionOwner.identity };

			const albumEditorTableRowTemplate = await this.queryTemplate("server-album-editor-row");
			const tableRow = albumEditorTableRowTemplate.content.firstElementChild.cloneNode(true);
			this.albumEditorTracksTableBody.append(tableRow);

			const ordinalInput = tableRow.querySelector("td.ordinal>input");
			ordinalInput.value = ((track.ordinal || 0) + 1).toString();
			ordinalInput.disabled = !!track.identity;

			const artistInput = tableRow.querySelector("td.artist>input");
			artistInput.value = track.artist || "";

			const titleInput = tableRow.querySelector("td.title>input");
			titleInput.value = track.title || "";

			const genreInput = tableRow.querySelector("td.genre>input");
			genreInput.value = track.genre || "";
	
			const recordingChooser = tableRow.querySelector("td.recording>input");
			recordingChooser.addEventListener("change", event => this.processSubmitTrackRecording(track, event.currentTarget.files[0], tableRow));

			const recordingButton = tableRow.querySelector("td.recording>button");
			recordingButton.addEventListener("click", event => recordingChooser.click());
			if ("recording-reference" in track.attributes) {
				const recording = await RADIO_SERVICE.findDocument(track.attributes["recording-reference"]);
				recordingButton.innerText = recording.description || recording.type;
			}

			const submitButton = tableRow.querySelector("td.action>button.submit");
			submitButton.addEventListener("click", event => this.processSubmitTrack(albumIdentity, track, tableRow));

			const removeButton = tableRow.querySelector("td.action>button.remove");
			removeButton.addEventListener("click", event => this.processDeleteTrack(track.identity, tableRow));
			removeButton.disabled = !track.identity;

			if (track.attributes["author-reference"] !== this.sessionOwner.identity && this.sessionOwner.group !== "ADMIN") {
				ordinalInput.disabled = artistInput.disabled = true;
				titleInput.disabled = genreInput.disabled = true;
				recordingButton.disabled = submitButton.disabled = removeButton.disabled = true;
			}
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Submits the given recording file, and registers it as the given track's recording.
	 * @param track the album track
	 * @param recordingFile the recording audio file
	 * @param tableRow the table row element
	 */
	async processSubmitTrackRecording (track, recordingFile, tableRow) {
		try {
			if (!recordingFile.type || !recordingFile.type.startsWith("audio/")) throw new RangeError();
			track.attributes["recording-reference"] = await RADIO_SERVICE.insertOrUpdateDocument(recordingFile);
			tableRow.querySelector("td.recording>button").innerText = recordingFile.name;

			this.messageOutput.value = "ok.";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Submits the given album track.
	 * @param albumIdentity the album identity
	 * @param track the track
	 * @param tableRow the table row element
	 */
	async processSubmitTrack (albumIdentity, track, tableRow) {
		try {
			track.ordinal = window.parseInt(tableRow.querySelector("td.ordinal>input").value.trim()) - 1;
			track.artist = tableRow.querySelector("td.artist>input").value.trim() || null;
			track.title = tableRow.querySelector("td.title>input").value.trim() || null;
			track.genre = tableRow.querySelector("td.genre>input").value.trim() || null;

			track.identity = await RADIO_SERVICE.insertOrUpdateTrack(albumIdentity, track);
			track.version = (track.version || 0) + 1;

			tableRow.querySelector("td.ordinal>input").disabled = true;
			tableRow.querySelector("td.action>button.remove").disabled = false;
			this.messageOutput.value = "ok.";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Removes the given track.
	 * @param trackIdentity the track identity
	 * @param tableRow the table row element
	 */
	async processDeleteTrack (trackIdentity, tableRow) {
		try {
			if (trackIdentity)
				await RADIO_SERVICE.deleteTrack(trackIdentity);

			tableRow.remove();
			this.messageOutput.value = "ok.";
		} catch (error) {
			this.messageOutput.value = error.message || error.toString();
			console.error(error);
		}
	}


	/**
	 * Removes the editor section and re-displays the refreshed table section.
	 */
	async processCancel () {
		this.albumEditorSection.remove();
		await this.#displayAllAlbums();
		this.albumsViewerSection.classList.remove("hidden");
	}
}


/*
 * Registers an event handler for the browser window's load event.
 */
window.addEventListener("load", event => {
	const controller = new ServerAlbumEditorTabPaneController();
	console.log(controller);
});
