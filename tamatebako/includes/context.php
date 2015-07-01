<?php
/**
 * Additional Context
 * for easier styling.
 * @since 3.0.0
 */

/* Load theme contexts setup */
add_action( 'after_setup_theme', 'tamatebako_contexts_setup', 5 );


/**
 * Contexts Setup
 * Additional classes for easier styling.
 *
 * @since 0.1.0
 */
function tamatebako_contexts_setup(){

	/* Admin: TinyMCE Editor Style */
	add_filter( 'tiny_mce_before_init', 'tamatebako_tinymce_body_class' );

	/* Additional Body Classes */
	add_filter( 'body_class', 'tamatebako_body_class' );

	/* Additional Post Classes */
	add_filter( 'post_class', 'tamatebako_post_class' );

	/* Additional Widgets Classes */
	add_filter( 'dynamic_sidebar_params', 'tamatebako_widget_class' );

}


/**
 * Add TinyMCE Body Class
 * Add "entry-content" in editor style, to use main style.css as editor style.
 * need to consider this when styling '<body>' and '<div class"entry-content">'.
 *
 * @since  0.1.0
 */
function tamatebako_tinymce_body_class( $settings ){
	$settings['body_class'] = $settings['body_class'] . ' entry-content';
	return $settings;
}


/**
 * Additional Body Class
 *
 * @since 0.1.0
 */
function tamatebako_body_class( $classes ){

	/* JS Status, need to be changed to "js" when js available */
	$classes[] = 'no-js';

	/* Get all registered sidebars */
	global $wp_registered_sidebars;

	/* If not empty sidebar */
	if ( !empty( $wp_registered_sidebars ) ){

		/* Foreach widget areas */
		foreach ( $wp_registered_sidebars as $sidebar ){

			/* Add active/inactive class */
			$classes[] = is_active_sidebar( $sidebar['id'] ) ? "sidebar-{$sidebar['id']}-active" : "sidebar-{$sidebar['id']}-inactive";
		}
	}

	/* Get all registered menus */
	$menus = get_registered_nav_menus();

	/* If not empty menus */
	if ( !empty( $menus ) ){

		/* For each menus */
		foreach ( $menus as $menu_id => $menu ){

			/* Add active/inactive class */
			$classes[] = has_nav_menu( $menu_id ) ? "menu-{$menu_id}-active" : "menu-{$menu_id}-inactive";
		}
	}

	/* Mobile visitor class */
	if ( wp_is_mobile() ){
		$classes[] = 'wp-is-mobile';
	}
	/* Non-mobile visitor/using desktop browser */
	else{
		$classes[] = 'wp-is-not-mobile';
	}

	/* Custom header */
	if ( current_theme_supports( 'custom-header' ) ){

		/* Header Image */
		if ( get_header_image() ) {
			$classes[] = 'custom-header-image';
		}
		else{
			$classes[] = 'custom-header-no-image';
		}
		/* Header Text */
		if ( display_header_text() ){
			$classes[] = 'custom-header-text';
		}
		else{
			$classes[] = 'custom-header-no-text';
		}
		/* Header Text Color */
		if ( get_header_textcolor() ) {
			$classes[] = 'custom-header-text-color';
		}
		else{
			$classes[] = 'custom-header-no-text-color';
		}
	}


	/* Make it unique */
	$classes = array_unique( $classes );

	return $classes;
}


/**
 * Add Post Class
 *
 * @since 0.1.0
 */
function tamatebako_post_class( $classes ){

	/* Post formats */
	if ( post_type_supports( get_post_type(), 'post-formats' ) ) {
		if ( get_post_format() ){
			$classes[] = 'has-format';
		}
	}

	/* Make it unique */
	$classes = array_unique( $classes );

	return $classes;
}


/**
 * Widget Class
 * @since 0.1.0
 */
function tamatebako_widget_class( $params ) {

	/* Global a counter array */
	global $tamatebako_widget_num;

	/* Get the id for the current sidebar we're processing */
	$this_id = $params[0]['id'];

	/* Get registered widgets */
	$arr_registered_widgets = wp_get_sidebars_widgets();

	/* If the counter array doesn't exist, create it */
	if ( !$tamatebako_widget_num ) {
		$tamatebako_widget_num = array();
	}

	/* if current sidebar has no widget, return. */
	if ( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) {
		return $params;
	}

	/* See if the counter array has an entry for this sidebar */
	if ( isset( $tamatebako_widget_num[$this_id] ) ) {
		$tamatebako_widget_num[$this_id] ++;
	}
	/* If not, create it starting with 1 */
	else {
		$tamatebako_widget_num[$this_id] = 1;
	}

	/* Add a widget number class for additional styling options */
	$class = 'class="widget widget-' . $tamatebako_widget_num[$this_id] . ' '; 

	/* in first widget, add 'widget-first' class */
	if ( $tamatebako_widget_num[$this_id] == 1 ) {
		$class .= 'widget-first ';
	}
	/* in last widget, add 'widget-last' class */
	elseif( $tamatebako_widget_num[$this_id] == count( $arr_registered_widgets[$this_id] ) ) { 
		$class .= 'widget-last ';
	}

	/* str replace before_widget param with new class */
	$params[0]['before_widget'] = str_replace( 'class="widget ', $class, $params[0]['before_widget'] );

	return $params;
}

