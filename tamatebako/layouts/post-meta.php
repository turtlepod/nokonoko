<?php
/**
 * Layouts Post Meta
 * @since 3.0.0
 */

/* === SET LAYOUT === */

/* Filters the theme layout mod. */
add_filter( 'theme_mod_theme_layout', 'tamatebako_set_post_layout', 6 );


/**
 * Filters the 'theme_mods_theme_layout'.
 */
function tamatebako_set_post_layout( $layout ) {

	/* Only in front end singular */
	if ( !is_admin() && is_singular() ){

		/* Check if current post type has layouts support */
		if ( post_type_supports( get_post_type( get_queried_object_id() ), 'theme-layouts' ) ) {

			/* Get list of available layouts */
			$layouts = array_keys( tamatebako_layouts() );

			/* Get current entry layout */
			$post_layout = tamatebako_get_post_layout( get_queried_object_id() );

			/* If current entry has layout and the current layout is valid layout, use it. */
			if( !empty( $post_layout ) && in_array( $post_layout, $layouts ) ){
				$layout = tamatebako_get_post_layout( get_queried_object_id() );
			}
		}
	}

	return $layout;
}


/* === VARS === */

/**
 * Meta Key
 */
function tamatebako_layout_meta_key(){
	return 'Layout';
}

/**
 * Get the post layout based on the given post ID.
 */
function tamatebako_get_post_layout( $post_id = '' ) {
	if( empty( $post_id ) ){
		$post_id = get_queried_object_id();
	}
	return get_post_meta( $post_id, tamatebako_layout_meta_key(), true );
}


/* === REGISTER META === */

/* Register Meta */
add_action( 'init', 'tamatebako_layouts_register_meta' );

/**
 * Registers the theme layouts meta key 
 */
function tamatebako_layouts_register_meta() {
	register_meta( 'post', tamatebako_layout_meta_key(), 'sanitize_html_class' );
}


/* === POST TYPE SUPPORT === */

/* Add post type support for theme layouts. */
add_action( 'init', 'tamatebako_layouts_add_post_type_support', 5 );

/**
 * Adds post type support to all 'public' post types.
 */
function tamatebako_layouts_add_post_type_support() {

	/* Add all public post type, except attachment. */
	$post_types = get_post_types( array( 'public' => true ) );
	foreach ( $post_types as $type ){
		if( 'attachment' != $type ){
			add_post_type_support( $type, 'theme-layouts' );
		}
	}
}

/* === ADMIN : META BOX / ATTACHMENT OPTION === */

/* Set up the custom post layouts. */
add_action( 'admin_init', 'tamatebako_layouts_admin_setup' );

/**
 * Setup Layouts Meta Box & Options
 */
function tamatebako_layouts_admin_setup() {
	/* Load meta boxes functions. */
	tamatebako_include( 'layouts/post-meta-box' );
}
