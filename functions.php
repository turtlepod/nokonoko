<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load Library. */
require_once( trailingslashit( get_template_directory() ) . 'library/tamatebako.php' );

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

	/* === MINIMUM SYSTEM REQ === */
	$back_compat_args = array(
		'theme_name'   => 'NokoNoko',
		'wp_requires'  => '4.1.0',
		'php_requires' => '5.2.4',
	);
	add_theme_support( 'tamatebako-back-compat', $back_compat_args );
	if( ! tamatebako_minimum_requirement( $back_compat_args ) ) return;

	/* === TRANSLATION === */
	tamatebako_include( 'translation', 'includes' );

	/* === SCRIPTS === */
	tamatebako_include( 'scripts', 'includes' );

	/* === CUSTOM FONTS === */
	tamatebako_include( 'custom-fonts', 'includes' );

	/* === SETUP: Sidebars, Menus, Image Sizes, Content Width === */
	tamatebako_include( 'setup', 'includes' );

	/* === LAYOUTS === */
	tamatebako_include( 'layouts', 'includes' );

	/* === BACKGROUND === */
	tamatebako_include( 'background', 'includes' );

	/* === HEADER IMAGE === */
	tamatebako_include( 'header-image', 'includes' );

	/* === LOGO === */
	tamatebako_include( 'logo', 'includes' );

	/* === UTILITY: Mobile View, Custom CSS === */
	tamatebako_include( 'utility', 'includes' );

	/* === POST FORMATS === */
	tamatebako_include( 'post-formats', 'includes' );

}

do_action( 'tamatebako_after_setup' );