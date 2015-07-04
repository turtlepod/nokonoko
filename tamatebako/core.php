<?php
/**
 * Tamatebako Library
 * A standalone theme library for faster theme development.
 * 
 * @version   3.0.0
 * @author    David Chandra <david@shellcreeper.com>
 * @copyright Copyright (c) 2015, David Chandra
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
**/

/**
 * Texts string / translatable string used in tamatebako.
 */
function tamatebako_string( $context ){

	$texts = array();

	/* layouts */
	$texts['default'] = 'Default';
	$texts['layout'] = 'Layout';
	$texts['global_layout'] = 'Global Layout';

	/* template/menu.php */
	$texts['next_posts'] = 'Next';
	$texts['previous_posts'] = 'Previous';

	/* template/menu.php */
	$texts['menu_search_placeholder'] = 'Search&hellip;';
	$texts['menu_search_button'] = 'Search';
	$texts['menu_search_form_toggle'] = 'Expand Search Form';

	/* template/content.php */
	$texts['error_title'] = '404 Not Found';
	$texts['error_message'] = 'Apologies, but no entries were found.';
	$texts['next_post'] = 'Next';
	$texts['previous_post'] = 'Previous';
	$texts['permalink'] = 'Permalink';

	/* template/comment.php */
	$texts['next_comment'] = 'Next';
	$texts['previous_comment'] = 'Previous';
	$texts['comments_closed_pings_open'] = 'Comments are closed, but trackbacks and pingbacks are open.';
	$texts['comments_closed'] = 'Comments are closed.';

	/* includes/setup.php */
	$texts['read_more'] = 'Read More';

	/* Filter */
	$texts = apply_filters( 'tamatebako_strings', $texts );

	/* Output */
	if ( isset( $texts[$context] ) ){
		return $texts[$context];
	}
	return $context;
}


/**
 * Include PHP File
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

	/* === SCRIPTS === */

	/* Register Script (JS) */
	tamatebako_require_if_theme_supports( 'tamatebako-register-js', 'tamatebako/scripts/register-js' );

	/* Enqueue Script (JS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-js', 'tamatebako/scripts/enqueue-js' );

	/* Register Style (CSS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-css', 'tamatebako/scripts/register-css' );

	/* Enqueue Style (CSS) */
	tamatebako_require_if_theme_supports( 'tamatebako-enqueue-css', 'tamatebako/scripts/enqueue-css' );

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

/* Template Tags */
if ( !is_admin() ) {
	tamatebako_include( 'tamatebako/template/load' );
}

/* Load Utility */
if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
	tamatebako_include( 'tamatebako/includes/utility' );
}

