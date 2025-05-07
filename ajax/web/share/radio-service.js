import basicFetch from "./basic-fetch.js";


/**
 * The radio service proxy type.
 */
class RadioServiceProxy extends Object {
	#protocol;
	#hostname;
	#port;
	#origin;


	/**
	 * Initializes a new instance by initializing the values of the web-service
	 * server's service protocol, service hostname, service port and service origin.
	 * For same origin policy (SOP) access, these must be set to the current DOM's
	 * location data, as the web-server must also host the web-services.
	 * For cross-origin resource sharing (CORS) access, these must be set different
	 * values as the web-service server's location will differ from the web-server's
	 * location!
	 */
	constructor () {
		super();

		this.#protocol = document.location.protocol;
		this.#hostname = document.location.hostname;
		this.#port = 8020; // document.location.port;
		this.#origin = this.#protocol + "//" + this.#hostname + ":" + this.#port;
	}


	/**
	 * Returns the documents URI.
	 * @return the documents URI
	 */
	get documentsURI () {
		return this.#origin + "/services/documents";
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/documents - application/json, and returns a
	 * promise for the matching documents.
	 * @param pagingOffset the paging offset, or null for undefined
	 * @param pagingLimit the paging limit, or null for undefined
	 * @param minCreated the minimum creation timestamp in ms since 1/1/1970, or null for undefined
	 * @param maxCreated the maximum creation timestamp in ms since 1/1/1970, or null for undefined
	 * @param minModified the minimum modification timestamp in ms since 1/1/1970, or null for undefined
	 * @param maxModified the maximum modification timestamp in ms since 1/1/1970, or null for undefined
	 * @param hash the hash, or null for undefined
	 * @param typeFragment the type fragment, or null for undefined
	 * @param descriptionFragment the description fragment, or null for undefined
	 * @param minSize the minimum size, or nullnull for undefined
	 * @param maxSize the maximum size, or null for undefined
	 * @return a promise for the matching auctions
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryDocuments (pagingOffset, pagingLimit, minCreated, maxCreated, minModified, maxModified, hash, typeFragment, descriptionFragment, minSize, maxSize) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/documents/{id} - * / *, and returns a promise
	 * for either the matching document or it's content.
	 * @param documentIdentity the document identity
	 * @param metadata true for document metadata, false for document content
	 * @return either the matching document, or it's binary content
	 */
	async findDocument (documentIdentity, metadata = true) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * POST /services/documents * text/plain,
	 * and returns a promise for the resulting document's identity.
	 * @param file the file
	 * @return a promise for the resulting document's identity
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async insertOrUpdateDocument (file) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * DELETE /services/documents/{id} - text/plain, and returns a
	 * promise for the identity of the deleted document.
	 * @param documentIdentity the document identity
	 * @return a promise for the identity of the deleted document
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async deleteDocument (documentIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/people - application/json, and returns a
	 * promise for the resulting people.
	 * @param pagingOffset the paging offset, or null for undefined
	 * @param pagingLimit the maximum paging size, or null for undefined
	 * @param minCreated the minimum creation timestamp, or null for undefined
	 * @param maxCreated the maximum creation timestamp, or null for undefined
	 * @param minModified the minimum modification timestamp, or null for undefined
	 * @param maxModified the maximum modification timestamp, or null for undefined
	 * @param email the email, or null for undefined
	 * @param group the group, or null for undefined
	 * @param title the title, or null for undefined
	 * @param surname the surname, or null for undefined
	 * @param forename the forename, or null for undefined
	 * @param street the street, or null for undefined
	 * @param city the city, or null for undefined
	 * @param country the country, or null for undefined
	 * @param postcode the postcode, or null for undefined
	 * @return a promise for the resulting people
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryPeople (pagingOffset, pagingLimit, minCreated, maxCreated, minModified, maxModified, email, group, title, surname, forename, street, city, country, postcode) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/people/requester - application/json, and
	 * returns a promise for the resulting requester.
	 * @param email the requester email, or null for none
	 * @param password the requester password, or null for none
	 * @return a promise for the resulting requester
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async findRequester (email, password) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/people/{id} - application/json, and
	 * returns a promise for the matching person.
	 * @param personIdentity the person identity
	 * @return a promise for the matching person
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async findPerson (personIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * POST /services/people application/json text/plain,
	 * and returns a promise for the resulting session owner's identity.
	 * @param person the person
	 * @param password the session owner's new password, or null for none
	 * @return a promise for the resulting session owner's identity
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async insertOrUpdatePerson (person, password = null) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * DELETE /services/people/{id} - text/plain, and returns a
	 * promise for the identity of the deleted person.
	 * @param personIdentity the person identity
	 * @return a promise for the identity of the deleted person
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async deletePerson (personIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/albums - application/json, and returns a
	 * promise for the resulting albums.
	 * @param pagingOffset the offset of the first result, or null for undefined
	 * @param pagingLimit the maximum number of results, or null for undefined
	 * @param minCreated the minimum creation timestamp, or null for undefined
	 * @param maxCreated the maximum creation timestamp, or null for undefined
	 * @param minModified the minimum modification timestamp, or null for undefined
	 * @param maxModified the maximum modification timestamp, or null for undefined
	 * @param titleFragment the title fragment, or null for undefined
	 * @param minReleaseYear the minimum release year, or null for undefined
	 * @param maxReleaseYear the maximum release year, or null for undefined
	 * @param minTrackTotal the minimum track total, or null for undefined
	 * @param maxTrackTotal the maximum track total, or null for undefined
	 * @param minTrackCount the minimum track count, or null for undefined
	 * @param maxTrackCount the maximum track count, or null for undefined
	 * @return a promise for the resulting albums
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryAlbums (pagingOffset, pagingLimit, minCreated, maxCreated, minModified, maxModified, titleFragment, minReleaseYear, maxReleaseYear, minTrackTotal, maxTrackTotal, minTrackCount, maxTrackCount) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/albums/{id} - application/json, and
	 * returns a promise for the matching album.
	 * @param albumIdentity the album identity
	 * @return a promise for the matching album
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async findAlbum (albumIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * POST /services/albums application/json text/plain, and
	 * returns a promise for the identity of the modified album.
	 * @param album the album
	 * @return a promise for the identity of the modified album
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async insertOrUpdateAlbum (album) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * DELETE /services/albums/{id} - text/plain, and returns a
	 * promise for the identity of the deleted album.
	 * @param albumIdentity the album identity
	 * @return a promise for the identity of the deleted album
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async deleteAlbum (albumIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/albums/{id}/tracks - application/json,
	 * and returns a promise for the resulting album tracks.
	 * @param albumIdentity the album identity
	 * @param pagingOffset the offset of the first result, or null for undefined
	 * @param pagingLimit the maximum number of results, or null for undefined
	 * @return a promise for the resulting album tracks
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryAlbumTracks (albumIdentity, pagingOffset, pagingLimit) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/tracks - application/json,
	 * and returns a promise for the resulting tracks.
	 * @param pagingOffset the offset of the first result, or null for undefined
	 * @param pagingLimit the maximum number of results, or null for undefined
	 * @param minCreated the minimum creation timestamp, or null for undefined
	 * @param maxCreated the maximum creation timestamp, or null for undefined
	 * @param minModified the minimum modification timestamp, or null for undefined
	 * @param maxModified the maximum modification timestamp, or null for undefined
	 * @param minOrdinal the minimum ordinal, or null for undefined
	 * @param maxOrdinal the maximum ordinal, or null for undefined
	 * @param artists the artists, or empty for undefined
	 * @param titles the titles, or empty for undefined
	 * @param genres the genres, or empty for undefined
	 * @param recorded whether or not there is an associated recording, or null for undefined
	 * @return a promise for the resulting tracks
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryTracks (pagingOffset, pagingLimit, minCreated, maxCreated, minModified, maxModified, minOrdinal, maxOrdinal, artists = [], titles = [], genres = [], recorded) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/tracks/{id} - application/json, and
	 * returns a promise for the matching track.
	 * @param trackIdentity the track identity
	 * @return a promise for the matching track
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async findTrack (trackIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * POST /services/albums/{id}/tracks application/json text/plain,
	 * and returns a promise for the identity of the modified track.
	 * @param albumIdentity the album identity
	 * @param track the track
	 * @return a promise for the identity of the modified track
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async insertOrUpdateTrack (albumIdentity, track) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * PUT /services/tracks/{id}/lyrics text/plain text/plain,
	 * and returns a promise for the resulting track identity.
	 * @param track the track
	 * @return a promise for the resulting track identity
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async updateTrackLyrics (track) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * DELETE /services/tracks/{id} - text/plain,
	 * and returns a promise for the identity of the deleted track.
	 * @param trackIdentity the track identity
	 * @return a promise for the identity of the deleted track
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async deleteTrack (trackIdentity) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/tracks/artists - application/json, and
	 * returns a promise for the resulting track artists.
	 * @param pagingOffset the offset of the first result, or null for undefined
	 * @param pagingLimit the maximum number of results, or null for undefined
	 * @return a promise for the resulting track artists
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryTrackArtists (pagingOffset, pagingLimit) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/tracks/genres - application/json, and
	 * returns a promise for the resulting track genres.
	 * @param pagingOffset the offset of the first result, or null for undefined
	 * @param pagingLimit the maximum number of results, or null for undefined
	 * @return a promise for the resulting track genres
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryTrackGenres (pagingOffset, pagingLimit) {
		// TODO
	}


	/**
	 * Remotely invokes the web-service method with HTTP signature
	 * GET /services/tracks/titles - application/json, and
	 * returns a promise for the resulting track titles.
	 * @param pagingOffset the offset of the first result, or null for undefined
	 * @param pagingLimit the maximum number of results, or null for undefined
	 * @return a promise for the resulting track titles
	 * @throws if the TCP connection to the web-service cannot be established, 
	 *			or if the HTTP response is not ok
	 */
	async queryTrackTitles (pagingOffset, pagingLimit) {
		// TODO
	}
}


// exports the radio service proxy singleton instance
const RADIO_SERVICE = new RadioServiceProxy();
export default RADIO_SERVICE;
