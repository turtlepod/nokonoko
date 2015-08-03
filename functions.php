<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load Library. */
require_once( trailingslashit( get_template_directory() ) . 'tamatebako/tamatebako.php' );

/* Load External Library. */
if( ! function_exists( 'get_the_image' ) ){
	require_once( trailingslashit( get_template_directory() ) . 'includes/get-the-image.php' );
}



/* Load theme general setup */
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * Setup
 */
function nokonoko_theme_setup(){

	/* Path */
	$theme_path = trailingslashit( get_template_directory() );
	$includes = trailingslashit( $theme_path . 'includes' );

	/* === TRANSLATION === */
	require_once( $includes . 'translation.php' );

	/* === SCRIPTS === */
	require_once( $includes . 'scripts.php' );

	/* === SETUP: Sidebars, Menus, Image Sizes, Content Width === */
	require_once( $includes . 'setup.php' );

	/* === LAYOUTS === */
	require_once( $includes . 'layouts.php' );

	/* === BACKGROUND === */
	require_once( $includes . 'background.php' );

	/* === HEADER IMAGE === */
	require_once( $includes . 'header-image.php' );

	/* === LOGO === */
	require_once( $includes . 'logo.php' );

	/* === UTILITY: Mobile View, Custom CSS === */
	require_once( $includes . 'utility.php' );

	/* === POST FORMATS === */
	require_once( $includes . 'post-formats.php' );

	/* === BACKWARD COMPATIBILITY === */
	$back_compat_args = array(
		'theme_name' => 'NokoNoko',
		'wp_requires' => '4.5',
		'php_requires' => '5.5',
	);
	add_theme_support( 'tamatebako-back-compat', $back_compat_args );

}

do_action( 'tamatebako_after_setup' );