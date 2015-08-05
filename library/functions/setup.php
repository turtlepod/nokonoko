<?php
/**
 * Setup Defaults Theme Features.
 * @since 3.0.0
 * @access private
**/

/* Setup the defaults theme feature. */
add_action( 'after_setup_theme', 'tamatebako_setup', 5 );

/**
 * Tamatebako Setup
 * @since 3.0.0
 * @access private
 */
function tamatebako_setup(){

	/* Enable Featured Image */
	add_theme_support( 'post-thumbnails' );

	/* Eanble Feed Link */
	add_theme_support( 'automatic-feed-links' );

	/* Enable HTML 5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	/* Enable Title Tag */
	add_theme_support( 'title-tag' );

	/* === WP HEAD === */

	add_action( 'wp_head', 'tamatebako_wp_head_meta_charset',   0 );
	add_action( 'wp_head', 'tamatebako_wp_head_meta_viewport',  1 );
	add_action( 'wp_head', 'tamatebako_wp_head_link_pingback',  3 );

	/* === SCRIPTS === */

	/* Stylesheet URI */
	add_filter( 'stylesheet_uri', 'tamatebako_stylesheet_uri', 5 );

	/* Scripts */
	add_action( 'wp_enqueue_scripts', 'tamatebako_scripts', 0 );

	/* === Filters: Set Better Default Output === */

	if( !is_admin() ){

		/* Archive Title & Desc */
		add_filter( 'get_the_archive_title', 'tamatebako_archive_title', 5 );
		add_filter( 'get_the_archive_description', 'tamatebako_archive_description', 5 );

		/* Set Untitled Entry Title */
		add_filter( 'the_title', 'tamatebako_untitled_entry_title' );

		/* Author posts link */
		add_filter( 'the_author_posts_link', 'tamatebako_the_author_posts_link', 5 );

		/* Set Consistent Read More */
		add_filter( 'excerpt_more', 'tamatebako_excerpt_more', 5 );
		add_filter( 'the_content_more_link', 'tamatebako_content_more', 5, 2 );

		/* WP Link Pages */
		add_filter( 'wp_link_pages_args', 'tamatebako_wp_link_pages', 5 );
		add_filter( 'wp_link_pages_link', 'tamatebako_wp_link_pages_link', 5 );

		/* Comments */
		add_filter( 'get_comment_author_link', 'tamatebako_get_comment_author_link', 5 );
		add_filter( 'get_comment_author_url_link', 'tamatebako_get_comment_author_url_link', 5 );

	} // end admin conditional
}


/**
 * Adds the meta charset to the header.
 * @author Justin Tadlock <justintadlock@gmail.com>
 * @return void
 */
function tamatebako_wp_head_meta_charset() {
	printf( '<meta charset="%s" />' . "\n", esc_attr( get_bloginfo( 'charset' ) ) );
}


/**
 * Adds the meta viewport to the header.
 * @author Justin Tadlock <justintadlock@gmail.com>
 */
function tamatebako_wp_head_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";
}


/**
 * Adds the pingback link to the header.
 * @author Justin Tadlock <justintadlock@gmail.com>
 */
function tamatebako_wp_head_link_pingback() {
	if ( 'open' === get_option( 'default_ping_status' ) ){
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}


/**
 * Current Active Theme Stylesheet URI
 */
function tamatebako_stylesheet_uri( $stylesheet_uri ){

	/* Child Theme Not Active */
	$parent_stylesheet_uri = tamatebako_get_parent_stylesheet_uri();
	if( ! is_child_theme() && !empty( $parent_stylesheet_uri ) ){
		$stylesheet_uri = $parent_stylesheet_uri;
	}
	return $stylesheet_uri;
}


/**
 * Register Scripts
 * @since 3.0.0
 */
function tamatebako_scripts(){

	/* == Register CSS == */

	/* Main active theme stylesheet */
	wp_register_style(
		'style',
		esc_url( get_stylesheet_uri() ),
		array(),
		is_child_theme() ? tamatebako_child_theme_version() : tamatebako_theme_version(),
		'all'
	);

	/* Parent theme CSS if child theme active */
	$parent_stylesheet_uri = tamatebako_get_parent_stylesheet_uri();
	if( is_child_theme() && !empty( $parent_stylesheet_uri ) ){
		wp_register_style(
			'parent',
			esc_url( $parent_stylesheet_uri ),
			array(),
			tamatebako_theme_version(),
			'all'
		);
	}

	/* === Load Comment Reply Scripts === */

	/* Load the comment reply script on singular posts with open comments if threaded comments are supported. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ){
		wp_enqueue_script( 'comment-reply' );
	}
}


/**
 * Add additional archive title.
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


/**
 * Add '(Untitled)' title if not entry title is set
 */
function tamatebako_untitled_entry_title( $title ) {
	if ( empty( $title ) && !is_singular() && in_the_loop() && !is_admin() ) {
		$title = tamatebako_string( 'untitled' );
	}
	return $title;
}


/**
 * Adds microdata to the author posts link.
 * @author Justin Tadlock <justintadlock@gmail.com>
 * @since  3.0.0
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
		'$1 class="url fn n"',
		'$1<span class="author-name">$2</span>$3'
	);
	return preg_replace( $pattern, $replace, $link );
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
 */
function tamatebako_wp_link_pages_link( $link ) {
	if ( 0 !== strpos( $link, '<a' ) ){
		$link = "<span class='page-numbers'>{$link}</span>";
	}
	return $link;
}


/**
 * Adds microdata to the comment author link.
 * @author Justin Tadlock <justintadlock@gmail.com>
 * @since  3.0.0
 * @access private
 * @param  string  $link
 * @return string
 */
function tamatebako_get_comment_author_link( $link ) {

	$patterns = array(
		'/(class=[\'"])(.+?)([\'"])/i',
		'/(<a.*?>)(.*?)(<\/a>)/i'
	);
	$replaces = array(
		'$1$2 fn n$3',
		'$1<span class="comment-author-name">$2</span>$3'
	);

	return preg_replace( $patterns, $replaces, $link );
}


/**
 * Adds microdata to the comment author URL link.
 * @author Justin Tadlock <justintadlock@gmail.com>
 * @since  3.0.0
 * @access private
 * @param  string  $link
 * @return string
 */
function tamatebako_get_comment_author_url_link( $link ) {

	$patterns = array(
		'/(class=[\'"])(.+?)([\'"])/i',
	);
	$replaces = array(
		'$1$2 fn n$3',
	);

	return preg_replace( $patterns, $replaces, $link );
}

