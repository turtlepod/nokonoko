<?php
/**
 * Additional context for easier styling.
 * @since 3.0.0
**/

/* Load theme contexts setup */
add_action( 'after_setup_theme', 'tamatebako_contexts_setup', 5 );

/**
 * Contexts Setup
 * Additional classes for easier styling.
 * @since 0.1.0
 */
function tamatebako_contexts_setup(){

	/* Admin: TinyMCE Editor Style */
	add_filter( 'tiny_mce_before_init', 'tamatebako_tinymce_body_class', 5 );

	/* Additional Body Classes */
	add_filter( 'body_class', 'tamatebako_body_class', 5 );

	/* Additional Post Classes */
	add_filter( 'post_class', 'tamatebako_post_class', 5, 3 );

}


/**
 * Add TinyMCE Body Class
 * Add "entry-content" in editor style for easier copy-paste CSS to editor.css
 * need to consider this when styling '<body>' and '<div class"entry-content">'.
 * @since  0.1.0
 */
function tamatebako_tinymce_body_class( $settings ){
	$settings['body_class'] = $settings['body_class'] . ' entry-content';
	return $settings;
}


/**
 * Additional Body Class
 * @since 0.1.0
 */
function tamatebako_body_class( $classes ){

	/* WordPress */
	$classes[] = 'wordpress';

	/* Text Direction */
	$classes[] = is_rtl() ? 'rtl' : 'ltr';

	/* Parent or Child Theme */
	$classes[] = is_child_theme() ? 'child-theme' : 'parent-theme';

	/* Multisite */
	if ( is_multisite() ) {
		$classes[] = 'multisite';
		$classes[] = 'blog-' . get_current_blog_id();
	}

	/* Is the current user logged in. */
	$classes[] = is_user_logged_in() ? 'logged-in' : 'logged-out';

	/* Plural/multiple-post view (opposite of singular). */
	if ( is_home() || is_archive() || is_search() ){
		$classes[] = 'plural';
	}

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
	$classes[] = wp_is_mobile() ? 'wp-is-mobile' : 'wp-is-not-mobile';

	/* Custom header */
	if ( current_theme_supports( 'custom-header' ) && get_header_image() ){

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
 * @since 0.1.0
 */
function tamatebako_post_class( $classes, $class, $post_id ){

	/* Do not filter admin */
	if ( is_admin() ){
		return $classes;
	}

	$post = get_post( $post_id );
	$post_type = get_post_type();
	$post_status = get_post_status();

	/* Entry */
	$classes[] = 'entry';

	/* Has excerpt. */
	if ( post_type_supports( $post->post_type, 'excerpt' ) && has_excerpt() ){
		$classes[] = 'has-excerpt';
	}

	/* Has <!--more--> link. */
	if ( !is_singular() && false !== strpos( $post->post_content, '<!--more-->' ) ){
		$classes[] = 'has-more-link';
	}

	/* Post formats */
	if ( post_type_supports( get_post_type(), 'post-formats' ) ) {
		if ( get_post_format() ){
			$classes[] = 'has-format';
		}
	}

	/* Has <!--more--> link. */
	if ( !is_singular() && false !== strpos( $post->post_content, '<!--more-->' ) ){
		$_classes[] = 'has-more-link';
	}

	/* Make it unique */
	$classes = array_unique( $classes );

	return $classes;
}
