<?php
/**
 * Tamatebako Library
 * A standalone theme library.
 * @version 3.0.0
**/


/**
 * Text String / Translatable string used in tamatebako
 * @since 0.1.0
 */
function tamatebako_string( $context ){

	$tamatebako_strings = array();

	/* Layouts */
	$tamatebako_strings['Default'] = 'Default';
	$tamatebako_strings['Layout'] = 'Layout';
	$tamatebako_strings['Global Layout'] = 'Global Layout';

	/* Filter */
	$tamatebako_strings = apply_filters( 'tamatebako_strings', $tamatebako_strings );

	/* Output */
	if ( isset( $tamatebako_strings[$context] ) ){
		return $tamatebako_strings[$context];
	}
	return $context;
}


/**
 * Include PHP File
 * @since 3.0.0
 */
function tamatebako_include( $file ){
	$path = trailingslashit( get_template_directory() ) . $file . '.php';
	if( file_exists( $path ) ) {
		include_once( $path );
	}
}
/**
 * Including a file if a theme feature is supported and the file exists.
 * @since 3.0.0
 */
function tamatebako_require_if_theme_supports( $feature, $file ) {
	$path = trailingslashit( get_template_directory() ) . $file . '.php';
	if ( current_theme_supports( $feature ) && file_exists( $path ) ){
		require_once( $path );
	}
}

/* Load Custom Theme Support Files */
add_action( 'after_setup_theme', 'tamatebako_load_theme_support', 15 );

/**
 * Load Theme Support Files
 * @since 3.0.0
 */
function tamatebako_load_theme_support(){

	/* Sidebar */
	tamatebako_require_if_theme_supports( 'tamatebako-sidebars', 'tamatebako/includes/sidebars' );

	/* Customizer Mobile View */
	tamatebako_require_if_theme_supports( 'tamatebako-customize-mobile-view', 'tamatebako/includes/mobile-view' );

	/* Theme Layouts */
	tamatebako_require_if_theme_supports( 'tamatebako-layouts', 'tamatebako/layouts/layouts' );

}


/* Helper Function */
tamatebako_include( 'tamatebako/includes/helper' );

/* Setup */
tamatebako_include( 'tamatebako/includes/setup' );

/* Context */
tamatebako_include( 'tamatebako/includes/context' );

/* Load CSS */
tamatebako_include( 'tamatebako/includes/load-css' );

/* Load JS */
tamatebako_include( 'tamatebako/includes/load-js' );

/* Load Utility */
if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
	tamatebako_include( 'tamatebako/includes/utility' );
}
















