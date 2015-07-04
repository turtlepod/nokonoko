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
	add_filter( 'excerpt_more', 'tamatebako_excerpt_more', 5 );
	add_filter( 'the_content_more_link', 'tamatebako_content_more', 5, 2 );

	/* WP Link Pages */
	add_filter( 'wp_link_pages_args', 'tamatebako_wp_link_pages', 5 );
	add_filter( 'wp_link_pages_link', 'tamatebako_wp_link_pages_link', 5 );
	
	/* Filters to add microdata support to common template tags. */
	add_filter( 'the_author_posts_link',          'tamatebako_the_author_posts_link',          5 );
	add_filter( 'get_comment_author_link',        'tamatebako_get_comment_author_link',        5 );
	add_filter( 'get_comment_author_url_link',    'tamatebako_get_comment_author_url_link',    5 );
	add_filter( 'comment_reply_link',             'tamatebako_comment_reply_link_filter',      5 );
	add_filter( 'get_avatar',                     'tamatebako_get_avatar',                     5 );
	add_filter( 'post_thumbnail_html',            'tamatebako_post_thumbnail_html',            5 );
	add_filter( 'comments_popup_link_attributes', 'tamatebako_comments_popup_link_attributes', 5 );

	/* Archive Title & Desc */
	add_filter( 'get_the_archive_title', 'tamatebako_archive_title', 5 );
	add_filter( 'get_the_archive_description', 'tamatebako_archive_description', 5 );
	
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


/**
 * Wraps page "links" that aren't actually links (just text) with `<span class="page-numbers">` so that they 
 * can also be styled.  This makes `wp_link_pages()` consistent with the output of `paginate_links()`.
 */
function tamatebako_wp_link_pages_link( $link ) {

	if ( 0 !== strpos( $link, '<a' ) )
		$link = "<span class='page-numbers'>{$link}</span>";

	return $link;
}



/**
 * Adds microdata to the author posts link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tamatebako_the_author_posts_link( $link ) {

	$pattern = array(
		"/(<a.*?)(>)/i",
		'/(<a.*?>)(.*?)(<\/a>)/i'
	);
	$replace = array(
		'$1 class="url fn n" itemprop="url"$2',
		'$1<span itemprop="name">$2</span>$3'
	);

	return preg_replace( $pattern, $replace, $link );
}

/**
 * Adds microdata to the comment author link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tamatebako_get_comment_author_link( $link ) {

	$patterns = array(
		'/(class=[\'"])(.+?)([\'"])/i',
		"/(<a.*?)(>)/i",
		'/(<a.*?>)(.*?)(<\/a>)/i'
	);
	$replaces = array(
		'$1$2 fn n$3',
		'$1 itemprop="url"$2',
		'$1<span itemprop="name">$2</span>$3'
	);

	return preg_replace( $patterns, $replaces, $link );
}

/**
 * Adds microdata to the comment author URL link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tamatebako_get_comment_author_url_link( $link ) {

	$patterns = array(
		'/(class=[\'"])(.+?)([\'"])/i',
		"/(<a.*?)(>)/i"
	);
	$replaces = array(
		'$1$2 fn n$3',
		'$1 itemprop="url"$2'
	);

	return preg_replace( $patterns, $replaces, $link );
}

/**
 * Adds microdata to the comment reply link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tamatebako_comment_reply_link_filter( $link ) {
	return preg_replace( '/(<a\s)/i', '$1itemprop="replyToUrl"', $link );
}

/**
 * Adds microdata to avatars.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $avatar
 * @return string
 */
function tamatebako_get_avatar( $avatar ) {
	return preg_replace( '/(<img.*?)(\/>)/i', '$1itemprop="image" $2', $avatar );
}

/**
 * Adds microdata to the post thumbnail HTML.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $html
 * @return string
 */
function tamatebako_post_thumbnail_html( $html ) {
	return function_exists( 'get_the_image' ) ? $html : preg_replace( '/(<img.*?)(\/>)/i', '$1itemprop="image" $2', $html );
}

/**
 * Adds microdata to the comments popup link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $attr
 * @return string
 */
function tamatebako_comments_popup_link_attributes( $attr ) {
	return 'itemprop="discussionURL"';
}


/**
 * Archive Description
 */
function tamatebako_archive_title( $title ){
	
	
	
	
	
	return $title;
}

/**
 * Archive Description
 */
function tamatebako_archive_description( $desc ){
	
	
	
	
	if( !empty( $desc ) ){
		return wpautop( $desc );
	}
	return $desc;
}







