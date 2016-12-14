<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load Library. */
require_once( trailingslashit( get_template_directory() ) . 'library/tamatebako.php' );

/* Load theme general setup */
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * Setup
 */
function nokonoko_theme_setup(){

	/* === MINIMUM SYSTEM REQ === */
	$back_compat_args = array(
		'theme_name'   => 'NokoNoko',
		'wp_requires'  => '4.7',
		'php_requires' => '5.3',
	);
	add_theme_support( 'tamatebako-back-compat', $back_compat_args );
	if( ! tamatebako_minimum_requirement( $back_compat_args ) ) return;

	/* === TRANSLATION === */
	tamatebako_include( 'includes/translation' );

	/* === SCRIPTS === */
	tamatebako_include( 'includes/scripts' );

	/* === SETUP: Sidebars, Menus, Image Sizes, Content Width === */
	tamatebako_include( 'includes/setup' );

	/* === LOGO === */
	tamatebako_include( 'includes/custom-logo' );

	/* === CUSTOM FONTS === */
	tamatebako_include( 'includes/custom-fonts' );

	/* === LAYOUTS === */
	tamatebako_include( 'includes/layouts' );

	/* === BACKGROUND === */
	tamatebako_include( 'includes/background' );

	/* === HEADER IMAGE === */
	tamatebako_include( 'includes/header-image' );

	/* === UTILITY: Custom CSS === */
	tamatebako_include( 'includes/utility' );

	/* === POST FORMATS === */
	tamatebako_include( 'includes/post-formats' );

	/* === CUSTOMIZER === */
	tamatebako_include( 'includes/customizer' );

	/* === FUNCTIONS === */
	tamatebako_include( 'includes/functions' );

	/* === UPDATER === */
	tamatebako_include( 'includes/updater' );

}

do_action( 'tamatebako_after_setup' );