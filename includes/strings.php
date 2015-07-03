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



