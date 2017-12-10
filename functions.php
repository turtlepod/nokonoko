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
		'wp_requires'  => '4.9',
		'php_requires' => '5.6',
	);
	add_theme_support( 'tamatebako-back-compat', $back_compat_args );
	if ( ! tamatebako_minimum_requirement( $back_compat_args ) ) {
		return;
	}

	// Initial Setup.
	tamatebako_include( 'includes/functions-setup' );

	// WordPress.
	tamatebako_include( 'includes/functions-wordpress' );

	// Framework.
	tamatebako_include( 'includes/functions-framework' );

	// Template functions.
	tamatebako_include( 'includes/functions-template' );

	// Utility functions.
	tamatebako_include( 'includes/functions-utility' );

	// Updater Class.
	tamatebako_include( 'includes/class-updater' );
}

do_action( 'tamatebako_after_setup' );