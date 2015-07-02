<?php
/**
 * Tamatebako Theme Layouts
 * Based on Hybrid Core 2.0 Theme Layouts Ext.
 *
 * @author    David Chandra <david@shellcreeper.com>
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
**/

/* === VARS === */

/**
 * Layouts Defined By Theme
 */
function tamatebako_theme_layouts(){
	return get_theme_support( 'tamatebako-layouts' );
}

/**
 * List Of Layouts
 */
function tamatebako_layouts() {

	/* Get theme-supported layouts. */
	$theme_layouts = tamatebako_theme_layouts();

	/* Set up Layouts. */
	$layouts = array(
		'default' => tamatebako_string( 'Default' ),
	);

	/* Assign the strings passed in by the theme author. */
	if ( isset( $theme_layouts[0] ) ){
		$layouts = array_merge( $layouts, $theme_layouts[0] );
	}

	return $layouts;
}

/**
 * Get Specific Layout Name From Layout Slug
 */
function tamatebako_layout_name( $layout ) {
	$layouts = tamatebako_layouts();
	return ( ( isset( $layouts[ $layout ] ) ) ? $layouts[ $layout ] : $layout );
}

/**
 * Array of arguments for layouts.
 */
function tamatebako_layouts_args() {

	$defaults = array( 
		'customize' => true, 
		'post_meta' => true, 
		'default'   => 'default' 
	);

	$layouts = tamatebako_theme_layouts();
	$args = isset( $layouts[1] ) ? $layouts[1] : array();
	return wp_parse_args( $args, $defaults );
}

/**
 * Default Layout
 */
function tamatebako_layout_default( $return = 'slug' ){
	$args = tamatebako_layouts_args();
	if( 'slug' == $return ){
		return $args['default'];
	}
	if( 'name' == $return ){
		return tamatebako_layout_name( $args['default'] );
	}
}


/* === SET DEFAULT LAYOUT === */

/* Filters the theme layout mod. */
add_filter( 'theme_mod_theme_layout', 'tamatebako_set_default_layout', 5 );


/**
 * Filters the 'theme_mods_theme_layout'.
 */
function tamatebako_set_default_layout( $layout ) {
	$layouts_args = tamatebako_layouts_args();
	if( true === $layouts_args['customize'] ){
		if ( empty( $layout ) ) {
			return tamatebako_layout_default();
		}
		else{
			return $layout;
		}
	}
	else{
		return tamatebako_layout_default();
	}
}


/* === GET CURRENT LAYOUT === */

/**
 * Get Current Layout
 */
function tamatebako_current_layout() {
	return get_theme_mod( 'theme_layout', tamatebako_layout_default() );
}


/* === ADD BODY CLASS === */

/* Filters the body_class hook to add a custom class. */
add_filter( 'body_class', 'tamatebako_layouts_body_class' );


/**
 * Adds the post layout class to the body class in the form of "layout-$layout".
 */
function tamatebako_layouts_body_class( $classes ) {
	$classes[] = sanitize_html_class( 'layout-' . tamatebako_current_layout() );
	return array_unique( $classes );
}


/* === LOAD === */

/* Get Features */
$layouts_args = tamatebako_layouts_args();

/**
 * Load Layouts Post Meta
 */
if( true === $layouts_args['post_meta'] ){
	tamatebako_include( 'tamatebako/layouts/post-meta' );
}

/**
 * Load Layouts Customizer
 */
if( true === $layouts_args['customize'] ){
	tamatebako_include( 'tamatebako/layouts/customize' );
}

