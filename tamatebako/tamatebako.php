<?php
/**
 * Tamatebako Box
 * A WordPress theme library for faster theme development.
 * 
 *  From the sea comes the sad, sweet voice of the princess:
 *  "I told you not to open that box. In it was your old age ..."
 * 
 * @version   3.0.0
 * @author    David Chandra <david@shellcreeper.com>
 * @copyright Copyright (c) 2015, David Chandra
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
**/

/**
 * Start Tamatebako!
 */
global $tamatebako;
$tamatebako = new stdClass;

/* Tamatebako directory */
define( 'TAMATEBAKO_DIR', basename( dirname( __FILE__ ) ) );

/* File loader. */
require_once( trailingslashit( get_template_directory() ) . TAMATEBAKO_DIR . '/functions/loader.php' );

/* Load text string used within the framework. */
tamatebako_include( 'functions/strings' );

/* Load default setup and helper functions. */
tamatebako_include( 'functions/setup' );

/* Load contexts function. */
tamatebako_include( 'functions/context' );

/* Load template-tag functions on site front end */
if ( !is_admin() ) {

	/* Accessibility */
	tamatebako_include( 'template/accessibility' );

	/* General */
	tamatebako_include( 'template/general' );

	/* Navigation Menu */
	tamatebako_include( 'template/menu' );

	/* Sidebar */
	tamatebako_include( 'template/sidebar' );

	/* Entry */
	tamatebako_include( 'template/entry' );

	/* Attachment */
	tamatebako_include( 'template/attachment' );

	/* Comment */
	tamatebako_include( 'template/comment' );

	/* Load front-end utility functions for faster development ( min PHP 5.3 ) */
	if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
		tamatebako_include( 'template/utility' );
	}
}

/* Load custom theme features files */
add_action( 'after_setup_theme', 'tamatebako_load_theme_support', 15 );

/**
 * Load Framework Feature Files
 * @since 3.0.0
 */
function tamatebako_load_theme_support(){

	/* Register Sidebar */
	tamatebako_require_if_theme_supports( 'tamatebako-sidebars', 'functions/sidebars' );

	/* Activate Mobile View in Customizer */
	tamatebako_require_if_theme_supports( 'tamatebako-customize-mobile-view', 'functions/mobile-view' );

	/* Theme Layouts */
	tamatebako_require_if_theme_supports( 'tamatebako-layouts', 'layouts/layouts' );

	/* === SCRIPTS === */

	/* Register Script (JS) */
	tamatebako_require_if_theme_supports( 'tamatebako-register-js', 'scripts/register-js' );

	/* Enqueue Script (JS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-js', 'scripts/enqueue-js' );

	/* Register Style (CSS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-css', 'scripts/register-css' );

	/* Enqueue Style (CSS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-css', 'scripts/enqueue-css' );

}
