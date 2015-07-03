<?php
/**
 * Text Strings Used In Theme
 */

/* Load Translation Files */
load_theme_textdomain( 'nokonoko', get_template_directory() . '/languages' );


/* Make Tamatebako text string translateable */
add_filter( 'tamatebako_strings', 'nokonoko_strings' );

/**
 * Text String Used in Theme.
 * @since 1.0.0
 */
function nokonoko_strings( $texts ){

	/* === Tamatebako === */

	/* Layouts */
	$texts['Default'] = __( 'Default', 'nokonoko' );
	$texts['Layout'] = __( 'Layout', 'nokonoko' );
	$texts['Global Layout'] = __( 'Global Layout', 'nokonoko' );

	/* Template/Menu */
	$text['Search...'] = _x( 'Search&hellip;', 'search text', 'nokonoko' );
	$text['Search'] = _x( 'Search', 'search button (accessibility)', 'nokonoko' );
	$text['Expand Search Form'] = _x( 'Expand Search Form', 'expand search form button (accessibility)', 'nokonoko' );

	/* Template/Content */
	$text['404 Not Found'] = _x( '404 Not Found', '404 title', 'nokonoko' );
	$text['Apologies, but no entries were found.'] = _x( 'Apologies, but no entries were found.', '404 content', 'nokonoko' );


	/* === Theme === */

	/* Register Layouts */
	$texts['One Column'] = __( 'One Column', 'nokonoko' );
	$texts['Two Columns'] = __( 'Two Columns', 'nokonoko' );

	/* Register Sidebars */
	$texts['Primary'] = __( 'Primary', 'nokonoko' );
	$texts['Secondary'] = __( 'Secondary', 'nokonoko' );

	/* Register Menus */
	$texts['Navigation'] = __( 'Navigation', 'nokonoko' );
	$texts['Footer Links'] = __( 'Footer Links', 'nokonoko' );

	return $texts;
}



