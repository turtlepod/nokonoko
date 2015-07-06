<?php
/**
 * Setup Defaults Theme Features.
 * @since 3.0.0
 * @access private
**/

/**
 * Helper Function: Get (parent) theme version
 * This function is to properly add version number to scripts and styles.
 * @since 0.1.0
 */
function tamatebako_theme_version(){
	$theme = wp_get_theme( get_template() );
	return $theme->get( 'Version' );
}


/* Setup the defaults theme feature. */
add_action( 'after_setup_theme', 'tamatebako_setup', 5 );

/**
 * Tamatebako Setup
 * @since 3.0.0
 * @access private
 */
function tamatebako_setup(){

	/* Enable Featured Image */
	add_theme_support( 'post-thumbnail' );

	/* Eanble Feed Link */
	add_theme_support( 'automatic-feed-links' );

	/* Enable HTML 5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	/* Enable Title Tag */
	add_theme_support( 'title-tag' );

	/* === Filters: Set Better Default Output === */

	/* Set Consistent Read More */
	add_filter( 'excerpt_more', 'tamatebako_excerpt_more', 5 );
	add_filter( 'the_content_more_link', 'tamatebako_content_more', 5, 2 );

	/* WP Link Pages */
	add_filter( 'wp_link_pages_args', 'tamatebako_wp_link_pages', 5 );
	add_filter( 'wp_link_pages_link', 'tamatebako_wp_link_pages_link', 5 );

	/* Archive Title & Desc */
	add_filter( 'get_the_archive_title', 'tamatebako_archive_title', 5 );
	add_filter( 'get_the_archive_description', 'tamatebako_archive_description', 5 );
}

/**
 * Default Excerpt More
 * to add more link to excerpt add template function "tamatebako_read_more()" after "the_excerpt()"
 * @since  0.1.0
 * @access private
 * @return string
 */
function tamatebako_excerpt_more( $more ) {
	return " &hellip; ";
}

/**
 * Content More
 * use the same markup as "tamatebako_read_more()" template function.
 * @since  0.1.0
 * @access private
 * @return string
 */
function tamatebako_content_more( $more_link, $more_link_text ){
	$string = tamatebako_string( 'read_more' );
	if ( !empty( $string ) ){
		return '<span class="more-link-wrap">' . str_replace( $more_link_text, '<span class="more-text">' . $string . '</span> <span class="screen-reader-text">' . get_the_title() . '</span>', $more_link ) . '</span>';
	}
	return $more_link;
}

/**
 * WP Link Pages
 * Add class to paragraph tag for easier styling.
 * @since 0.1.0
 * @access private
 * @return string
 */
function tamatebako_wp_link_pages( $args ){
	$args['before'] = '<p class="wp-link-pages">';
	$args['after'] = '</p>';
	return $args;
}


/**
 * Wraps page "links" that aren't actually links (just text) with `<span class="page-numbers">` so that they 
 * can also be styled.  This makes `wp_link_pages()` consistent with the output of `paginate_links()`.
 * @author Justin Tadlock <justintadlock@gmail.com>
 * @since  3.0.0
 * @access private
 * @return string
 */
function tamatebako_wp_link_pages_link( $link ) {
	if ( 0 !== strpos( $link, '<a' ) ){
		$link = "<span class='page-numbers'>{$link}</span>";
	}
	return $link;
}

/**
 * Add blog page title as archive title.
 * @since  3.0.0
 * @access private
 * @param  string  $title
 * @return string
 */
function tamatebako_archive_title( $title ){
	/* Blog Page. */
	if( is_home() && !is_front_page() ){
		$title = get_post_field( 'post_title', get_queried_object_id() );
	}
	/* Search result page. */
	if( is_search() ){
		$title = tamatebako_string( 'search_title_prefix' ) . sprintf( " &#8220;%s&#8221;", get_search_query() );
	}
	return $title;
}

/**
 * Add additional archive description.
 * @since  3.0.0
 * @access private
 * @param  string  $title
 * @return string
 */
function tamatebako_archive_description( $desc ){

	/* Blog Page. */
	if( is_home() && !is_front_page() ){
		$desc = get_post_field( 'post_content', get_queried_object_id(), 'raw' );
	}
	/* Author Page. */
	elseif ( is_author() ){
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	}
	/* Post Type Archive. */
	elseif ( is_post_type_archive() ){
		$desc = get_post_type_object( get_query_var( 'post_type' ) )->description;
	}

	/* Add paragraph tags. */
	if( !empty( $desc ) ){
		return wpautop( $desc );
	}

	/* Return it. */
	return $desc;
}

