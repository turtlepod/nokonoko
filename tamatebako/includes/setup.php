<?php
/**
 * Setup 
 * @since 3.0.0
 */

/* After Setup Theme */
add_action( 'after_setup_theme', 'tamatebako_setup', 5 );

/**
 * Library Default Setup
 * @since 3.0.0
 */
function tamatebako_setup(){

	/* Featured Image */
	add_theme_support( 'post-thumbnail' );

	/* Feed Link */
	add_theme_support( 'automatic-feed-links' );

	/* HTML 5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	/* Title Tag */
	add_theme_support( 'title-tag' );

	/* === Filters: Set Better Default Output === */

	/* Set Consistent Read More */
	add_filter( 'excerpt_more', 'tamatebako_excerpt_more' );
	add_filter( 'the_content_more_link', 'tamatebako_content_more', 10, 2 );

	/* WP Link Pages */
	add_filter( 'wp_link_pages_args', 'tamatebako_wp_link_pages' );
	
	
	
	
	
	
}



/**
 * Default Excerpt More
 * to add more link to excerpt add template function "tamatebako_read_more()" after "the_excerpt()"
 * 
 * @since 0.1.0
 */
function tamatebako_excerpt_more( $more ) {
	return " &hellip; ";
}


/**
 * Content More
 * use the same markup as "tamatebako_read_more()" template function.
 *
 * @since 0.1.0
 */
function tamatebako_content_more( $more_link, $more_link_text ){
	$string = tamatebako_string( 'read-more' );
	if ( !empty( $string ) ){
		return '<span class="more-link-wrap">' . str_replace( $more_link_text, '<span class="more-text">' . tamatebako_string( 'read-more' ) . '</span> <span class="screen-reader-text">' . get_the_title() . '</span>', $more_link ) . '</span>';
	}
	return $more_link;
}

/**
 * WP Link Pages
 * Add class to paragraph tag for easier styling.
 *
 * @since 0.1.0
 */
function tamatebako_wp_link_pages( $args ){
	$args['before'] = '<p class="wp-link-pages">';
	$args['after'] = '</p>';
	return $args;
}
















