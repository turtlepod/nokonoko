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
 * @copyright Copyright (c) 2015, Genbu Media
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
**/

/**
 * Start Tamatebako!
 */
global $tamatebako;
$tamatebako = new stdClass;

/* Constant: Tamatebako Directory (not path) */
define( 'TAMATEBAKO_DIR', basename( dirname( __FILE__ ) ) );

/* === LOAD FUNCTIONS === */

/* Load File Loader. */
require_once( trailingslashit( get_template_directory() ) . TAMATEBAKO_DIR . '/functions/helper.php' );

/* Load text string used within the framework. */
tamatebako_include( 'functions/strings' );

/* Load various sanitization functions. */
tamatebako_include( 'functions/sanitize' );

/* Load default setup and helper functions. */
tamatebako_include( 'functions/setup' );

/* Load contexts function. */
tamatebako_include( 'functions/context' );

/* Load template-tag functions on site front end. */
if ( !is_admin() ) {

	/* Accessibility */
	tamatebako_include( 'functions/template/accessibility' );

	/* General */
	tamatebako_include( 'functions/template/general' );

	/* Navigation Menu */
	tamatebako_include( 'functions/template/menu' );

	/* Sidebar */
	tamatebako_include( 'functions/template/sidebar' );

	/* Entry */
	tamatebako_include( 'functions/template/entry' );

	/* Attachment */
	tamatebako_include( 'functions/template/attachment' );

	/* Comment */
	tamatebako_include( 'functions/template/comment' );

	/* Load front-end utility functions for faster development ( min PHP 5.3 ) */
	if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
		tamatebako_include( 'functions/template/utility' );
	}
}

/* === LOAD MODULES === */

/* Load custom theme features. */
add_action( 'after_setup_theme', 'tamatebako_load_theme_support', 15 );

/**
 * Load Framework Feature Files
 * @since 3.0.0
 */
function tamatebako_load_theme_support(){

	/* === REGISTER SIDEBARS === */

	tamatebako_require_if_theme_supports( 'tamatebako-sidebars', 'modules/sidebars' );

	/* === CUSTOMIZER MOBILE VIEW === */

	tamatebako_require_if_theme_supports( 'tamatebako-customize-mobile-view', 'modules/mobile-view' );

	/* === POST FORMATS SETUP === */

	tamatebako_require_if_theme_supports( 'post-formats', 'modules/post-formats' );

	/* === FULL SIZE BACKGROUND === */

	if ( current_theme_supports( 'custom-background' ) ){
		tamatebako_require_if_theme_supports( 'tamatebako-full-size-background', 'modules/full-size-background' );
	}

	/* === MICRODATA FILTERS === */

	tamatebako_require_if_theme_supports( 'tamatebako-microdata', 'modules/microdata' );

	/* === LOGO === */

	tamatebako_require_if_theme_supports( 'tamatebako-logo', 'modules/logo' );

	/* === LAYOUTS === */

	tamatebako_require_if_theme_supports( 'tamatebako-layouts', 'modules/layouts/layouts' );

	/* === CUSTOM CSS === */

	tamatebako_require_if_theme_supports( 'tamatebako-custom-css', 'modules/custom-css/custom-css' );

	/* === SCRIPTS === */

	/* Register Script (JS) */
	tamatebako_require_if_theme_supports( 'tamatebako-register-js', 'modules/scripts/register-js' );

	/* Enqueue Script (JS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-js', 'modules/scripts/enqueue-js' );

	/* Register Style (CSS) */
	tamatebako_require_if_theme_supports( 'tamatebako-register-css', 'modules/scripts/register-css' );

	/* Enqueue Style (CSS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-css', 'modules/scripts/enqueue-css' );

}
