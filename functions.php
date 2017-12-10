<?php
/**
 * Theme Functions
 *
 * @since 1.0.0
 * @author GenbuMedia
 */

// Load library.
require_once( trailingslashit( get_template_directory() ) . 'library/tamatebako.php' );

// Load theme general setup.
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * Setup.
 * Loaded early so child theme can easily override it.
 *
 * @since 1.0.0
 */
function nokonoko_theme_setup(){

	// Minimum system requirements.
	$back_compat_args = array(
		'theme_name'   => 'NokoNoko',
		'wp_requires'  => '4.7',
		'php_requires' => '5.3',
	);
	add_theme_support( 'tamatebako-back-compat', $back_compat_args );
	if ( ! tamatebako_minimum_requirement( $back_compat_args ) ) {
		return;
	}

	// Translations.
	tamatebako_include( 'includes/translation' );

	// Scripts.
	tamatebako_include( 'includes/scripts' );

	// Setup.
	tamatebako_include( 'includes/setup' );

	// Logo.
	tamatebako_include( 'includes/custom-logo' );

	// Custom fonts.
	tamatebako_include( 'includes/custom-fonts' );

	// Layouts.
	tamatebako_include( 'includes/layouts' );

	// Backgrund.
	tamatebako_include( 'includes/background' );

	// Header image.
	tamatebako_include( 'includes/header-image' );

	// Utility.
	tamatebako_include( 'includes/utility' );

	// Post Formats.
	tamatebako_include( 'includes/post-formats' );

	// Customizer.
	tamatebako_include( 'includes/customizer' );

	// Functions.
	tamatebako_include( 'includes/functions' );

	// Updater.
	tamatebako_include( 'includes/updater' );
}

do_action( 'tamatebako_after_setup' );