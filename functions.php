<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load Library. */
require_once( trailingslashit( get_template_directory() ) . 'tamatebako/tamatebako.php' );

/* Load Stuff. */
if( ! function_exists( 'get_the_image' ) ){
	require_once( trailingslashit( get_template_directory() ) . 'includes/get-the-image.php' );
}

/* Load theme general setup */
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * Setup
 */
function nokonoko_theme_setup(){

	/* Vars */
	$theme_path = trailingslashit( get_template_directory() );
	$includes = trailingslashit( $theme_path . 'includes' );

	/* === TRANSLATION === */
	require_once( $includes . 'translation.php' );

	/* === LAYOUTS === */
	require_once( $includes . 'layouts.php' );

	/* === SCRIPTS === */
	require_once( $includes . 'scripts.php' );

	/* === BACKGROUND === */
	require_once( $includes . 'background.php' );

	/* === HEADER IMAGE === */
	require_once( $includes . 'header-image.php' );

	/* === LOGO === */
	require_once( $includes . 'logo.php' );

	/* === UTILITY: MOBILE VIEW + CUSTOM CSS === */
	require_once( $includes . 'utility.php' );

	/* === POST FORMATS === */
	require_once( $includes . 'post-formats.php' );

}

do_action( 'tamatebako_after_setup' );