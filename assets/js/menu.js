/**
 * Menu Toggle
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
	 * Menu Toggle
	 *
	 * @since 4.0.0
	 */
	tamatebako.menuToggle = function() {
		// Menu toggle.
		$( '.menu-toggle a' ).click( function(e) {
			e.preventDefault();
			$( this ).parents( '.menu-container' ).toggleClass( 'menu-toggle-active' );
		});

		// Search toggle.
		$( '.search-toggle' ).click( function(e) {
			e.preventDefault();
			$( this ).parents( '.menu-search' ).toggleClass( 'search-toggle-active' );
			$( this ).siblings( '.search-field' ).focus();
		} );

		// Open search on search page.
		if ( $( 'body' ).hasClass( 'search' ) ) {
			$( '.search-toggle' ).parents( '.menu-search' ).addClass( 'search-toggle-active' );
		}
	};

	/**
	 * Sub Menu Toggle
	 *
	 * @since 4.0.0
	 */
	tamatebako.submenuToggle = function() {
		// Only for mobile.
		if ( ! tamatebako.isMobile() ) {
			return;
		}

		// Foreach parent menu item.
		$( '.menu-container .menu-item-has-children' ).each( function () {

			// If this parent menu item have sub-menu available.
			if ( $( this ).children( 'ul' ).length > 0 ) {

				// Functionality only for regular menu, not menu toggle.
				if ( $( '#menu-toggle-primary' ).css( 'display' ) !== 'block' ) {

					// Toggle class to open .sub-menu.
					$( this ).children( 'a' ).click( function(e) {
						e.preventDefault();
						$( this ).parent( 'li' ).siblings( 'li' ).removeClass( 'menu-item-open-children' );
						$( this ).parent( 'li' ).toggleClass( 'menu-item-open-children' );

						// Get menu link, and add it as first children.
						if ( ! $( this ).parent( 'li' ).children( '.sub-menu' ).children( 'li' ).hasClass( 'menu-item-parent-link' ) ) {
							// Only if not linked to "#".
							if ( $( this ).attr( 'href' ) !== '#' ) {
								$( this ).parent( 'li' ).children( '.sub-menu' ).prepend( '<li class="menu-item menu-item-parent-link">' + $( this ).parent( 'li' ).html() + '</li>' );
							}
						}

						// Remove sub menu from this.
						$( '.menu-item-parent-link' ).children( '.sub-menu' ).remove();
					} );

				} else { // Already using mobile menu toggle, revert to default action.

					$( this ).children( 'a' ).unbind( 'click' );
					$( '.menu-item-parent-link' ).remove();
					$( '.menu-item-open-children' ).removeClass( 'menu-item-open-children' );
				}
			}
		} );
	};

	/**
	 * Wait for DOM ready.
	 *
	 * @since 4.0.0
	 */
	$document.ready( function() {
		// Accessibility Menu Focus.
		$( '.menu-dropdown' ).find( 'a' ).on( 'focus blur', function() {
			$( this ).parents().toggleClass( 'focus' );
		} );

		// HTML Class.
		if ( tamatebako.isMobile() ) {
			$( 'body' ).addClass( 'mobile-menu-active' );
		} else {
			$( 'body' ).removeClass( 'mobile-menu-active' );
		}

		// Load menu.
		tamatebako.menuToggle();
		tamatebako.submenuToggle();

		/* Load on resize */
		$( window ).resize( function() {
			tamatebako.submenuToggle();
		});

	} );

}( window ) );
