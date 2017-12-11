/**
 * FitVids
 *
 * @since 4.0.0
 */
( function( window, undefined ) {

	window.wp = window.wp || {};

	var document = window.document;
	var $ = window.jQuery;
	var wp = window.wp;
	var $document = $(document);

	/**
	 * Wait for DOM ready.
	 *
	 * @since 4.0.0
	 */
	$document.ready( function() {
		if ( typeof fitVids !== undefined ) {
			$( '#content,.entry-content,.entry-summary,.widget' ).fitVids();
		}
	} );

}( window ) );
