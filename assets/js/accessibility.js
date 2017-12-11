/**
 * Accessibility
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
	 * Accessibility Focus
	 *
	 * @since 4.0.0
	 */
	tamatebako.accessibilityFocus = function() {
		// Focus input element on Hash "#" change, modified from twenty fourteen theme.
		var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
			is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
			is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

		if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
			window.addEventListener( 'hashchange', function() {
				var element = document.getElementById( location.hash.substring( 1 ) );
				if ( element ) {
					if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
						element.tabIndex = -1;
					element.focus();
				}
			}, false );
		}
	};

	/**
	 * Mobile Detection
	 *
	 * @since 4.0.0
	 *
	 * @return bool
	 */
	tamatebako.isMobile = function() {
		if( navigator.userAgent.match(/Mobile/i)
			|| navigator.userAgent.match(/Android/i)
			|| navigator.userAgent.match(/Silk/i)
			|| navigator.userAgent.match(/Kindle/i)
			|| navigator.userAgent.match(/BlackBerry/i)
			|| navigator.userAgent.match(/Opera Mini/i)
			|| navigator.userAgent.match(/Opera Mobi/i) ) {
			return true;
		} else {
			return false;
		}
	};

	/**
	 * Wait for DOM ready.
	 *
	 * @since 4.0.0
	 */
	$document.ready( function() {
		tamatebako.accessibilityFocus();

		if ( ! tamatebako.isMobile() ) {
			$( 'body' ).removeClass( 'wp-is-not-mobile' ).addClass( 'wp-is-mobile' );
		} else {
			$( 'body' ).removeClass( 'wp-is-mobile' ).addClass( 'wp-is-not-mobile' );
		}

	} );

}( window ) );
