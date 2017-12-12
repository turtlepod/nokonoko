<?php
/**
 * Setup Defaults Theme Features.
 *
 * @since 3.0.0
 * @author GenbuMedia
 * @access private
**/

// Setup the defaults theme feature.
add_action( 'after_setup_theme', 'tamatebako_setup', 5 );

/**
 * Tamatebako Setup
 *
 * @since 3.0.0
 * @access private
 */
function tamatebako_setup() {
	// Enable Featured Image for all post types.
	add_theme_support( 'post-thumbnails' );

	// Enable feed link.
	add_theme_support( 'automatic-feed-links' );

	// Enable HTML 5.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Enable title tag.
	add_theme_support( 'title-tag' );

	// WP Head output.
	add_action( 'wp_head', 'tamatebako_wp_head', 0 );

	// Widgets: Selective Refresh Support.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/* === SCRIPTS === */

	// Custom stylesheet URI
	add_filter( 'stylesheet_uri', 'tamatebako_stylesheet_uri', 5 );

	// Scripts.
	add_action( 'wp_enqueue_scripts', 'tamatebako_styles', 1 );
	add_action( 'wp_enqueue_scripts', 'tamatebako_scripts', 1 );

	/* === Filters: Set Better Default Output === */

	// TinyMCE add body class "entry-content" for easier styling.
	add_filter( 'tiny_mce_before_init', 'tamatebako_tinymce_body_class', 5 );

	// Template Hierarchy: Front Page Template Fix.
	add_filter( 'frontpage_template', 'tamatebako_front_page_template' );

	if( ! is_admin() ) {

		// Context: Body Class & Post Class.
		add_filter( 'body_class', 'tamatebako_body_class', 5 );
		add_filter( 'post_class', 'tamatebako_post_class', 5, 3 );

		// Archive Title & Desc.
		add_filter( 'get_the_archive_title', 'tamatebako_archive_title', 5 );
		add_filter( 'get_the_archive_description', 'tamatebako_archive_description', 5 );

		// Set Untitled Entry Title.
		add_filter( 'the_title', 'tamatebako_untitled_entry_title' );

		// Author posts link.
		add_filter( 'the_author_posts_link', 'tamatebako_the_author_posts_link', 5 );

		// Set Consistent Read More.
		add_filter( 'excerpt_more', 'tamatebako_excerpt_more', 5 );
		add_filter( 'the_content_more_link', 'tamatebako_content_more', 5, 2 );

		// WP Link Pages.
		add_filter( 'wp_link_pages_args', 'tamatebako_wp_link_pages', 5 );
		add_filter( 'wp_link_pages_link', 'tamatebako_wp_link_pages_link', 5 );

		// Edit Post Link.
		add_filter( 'edit_post_link', 'tamatebako_edit_post_link', 5, 3 );

		// Comments.
		add_filter( 'comment_form_defaults', 'tamatebako_comment_form_defaults', 5 );
		add_filter( 'get_comment_author_link', 'tamatebako_get_comment_author_link', 5 );
		add_filter( 'get_comment_author_url_link', 'tamatebako_get_comment_author_url_link', 5 );

		// SVG Icons.
		add_action( 'wp_footer', 'tamatebako_svg_sprite_load', 9999 );

	}
}

/**
 * Adds stuff to the head.
 * - Javascript detection script.
 * - Charset.
 * - Viewport.
 * - Pingback.
 *
 * @since 3.0.0
 */
function tamatebako_wp_head() {
?>
<script type="text/javascript">
/* <![CDATA[ */
document.documentElement.className = document.documentElement.className.replace(new RegExp('(^|\\s)no-js(\\s|$)'), '$1js$2');
/* ]]> */
</script>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( 'open' === get_option( 'default_ping_status' ) ){ ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php } // end pingback ?>
<?php
}

/**
 * Current Active Theme Stylesheet URI
 * Change the stylesheet uri for parent theme.
 *
 * @since 3.0.0
 *
 * @param string $stylesheet_uri Style CSS URL.
 * @return string
 */
function tamatebako_stylesheet_uri( $stylesheet_uri ) {
	$parent_css = tamatebako_get_parent_stylesheet_uri();
	if ( ! is_child_theme() && $parent_css ) {
		$stylesheet_uri = $parent_css;
	}
	return $stylesheet_uri;
}

/**
 * Register Styles
 *
 * @since 3.0.0
 */
function tamatebako_styles() {
	global $tamatebako;

	// Register Main (Parent Theme) CSS.
	$stylesheet_uri = get_stylesheet_uri();
	$parent_css = tamatebako_get_parent_stylesheet_uri();
	$parent_css = is_child_theme() ? $parent_css : $stylesheet_uri;

	if ( $parent_css ) {
		wp_register_style(
			esc_attr( $tamatebako->name . '-style' ),
			esc_url( $parent_css ),
			array(),
			tamatebako_is_debug() ? time() : tamatebako_theme_version(),
			'all'
		);
	}

	// Register Child Theme CSS ( Only if child theme active ).
	if ( is_child_theme() ) {
		wp_register_style(
			esc_attr( $tamatebako->child . '-style' ),
			esc_url( $stylesheet_uri ),
			array( sanitize_title( $tamatebako->name ) . '-style' ),
			tamatebako_is_debug() ? time() : tamatebako_child_theme_version(),
			'all'
		);
	}
}

/**
 * Enqueue Scripts
 * Load the comment reply script on singular posts with open comments if threaded comments are supported.
 *
 * @since 3.0.0
 */
function tamatebako_scripts() {
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ){
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Add TinyMCE Body Class
 * Add "entry-content" in editor style for easier copy-paste CSS to editor.css
 * need to consider this when styling '<body>' and '<div class"entry-content">'.
 *
 * @since  0.1.0
 *
 * @param array $settings TinyMCE Settings.
 * @return array
 */
function tamatebako_tinymce_body_class( $settings ) {
	$settings['body_class'] = "{$settings['body_class']} entry-content";
	return $settings;
}

/**
 * Fix WordPress Front Page Template
 * This will enable page template even when front-page.php exist.
 * This will not load front-page.php if blog is set as front page.
 *
 * @since 3.3.3
 * @author Jenny Regan (Theme Hybrid)
 *
 * @param string $template Template.
 * @return string
 */
function tamatebako_front_page_template( $template ) {
	return ( is_home() || locate_template( get_page_template_slug() ) ) ? '' : $template;
}

/**
 * Additional Body Class
 *
 * @since 0.1.0
 *
 * @param array $classes Body Classes.
 * @return array
 */
function tamatebako_body_class( $classes ) {
	$classes[] = 'wordpress';
	$classes[] = is_rtl() ? 'rtl' : 'ltr';
	$classes[] = is_child_theme() ? 'child-theme' : 'parent-theme';

	if ( is_multisite() ) {
		$classes[] = 'multisite';
		$classes[] = 'blog-' . get_current_blog_id();
	}

	// Current user login info.
	$classes[] = is_user_logged_in() ? 'logged-in' : 'logged-out';

	// Plural/multiple-post view (opposite of singular).
	if ( is_home() || is_archive() || is_search() ) {
		$classes[] = 'plural';
	}

	//  Singular.
	if( is_singular() ){
		$classes[] = 'singular';
	}

	// Get all registered sidebars. Add active/inactive class.
	global $wp_registered_sidebars;
	if ( ! empty( $wp_registered_sidebars ) ) {
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$classes[] = is_active_sidebar( $sidebar['id'] ) ? "sidebar-{$sidebar['id']}-active" : "sidebar-{$sidebar['id']}-inactive";
		}
	}

	// Get all registered menus. Add active/inactive class.
	$menus = get_registered_nav_menus();
	if ( ! empty( $menus ) ) {
		foreach ( $menus as $menu_id => $menu ) {
			$classes[] = has_nav_menu( $menu_id ) ? "menu-{$menu_id}-active" : "menu-{$menu_id}-inactive";
		}
	}

	// Mobile visitor class.
	$classes[] = wp_is_mobile() ? 'wp-is-mobile' : 'wp-is-not-mobile';

	// Custom header.
	if ( current_theme_supports( 'custom-header' ) && get_header_image() ) {
		if ( get_header_image() ) {
			$classes[] = 'custom-header-image';
		} else {
			$classes[] = 'custom-header-no-image';
		}

		if ( display_header_text() ) {
			$classes[] = 'custom-header-text';
		} else {
			$classes[] = 'custom-header-no-text';
		}

		if ( get_header_textcolor() ) {
			$classes[] = 'custom-header-text-color';
		} else {
			$classes[] = 'custom-header-no-text-color';
		}
	}

	// Admin/super-admin.
	if ( is_super_admin() ) {
		$classes[] = 'tamatebako-super';
	}

	return $classes;
}

/**
 * Add Post Class
 *
 * @since 0.1.0
 *
 * @param array $classes An array of post classes.
 * @param array $class   An array of additional classes added to the post.
 * @param int   $post_id Post ID.
 * @return array
 */
function tamatebako_post_class( $classes, $class, $post_id ) {
	$post = get_post( $post_id );

	// Entry class.
	$classes[] = 'entry';

	// Has excerpt.
	if ( post_type_supports( $post->post_type, 'excerpt' ) && has_excerpt() ) {
		$classes[] = 'has-excerpt';
	}

	// Has <!--more--> link.
	if ( ! is_singular() && false !== strpos( $post->post_content, '<!--more-->' ) ) {
		$classes[] = 'has-more-link';
	}

	// Post formats.
	if ( post_type_supports( $post->post_type, 'post-formats' ) ) {
		if ( get_post_format( $post ) ) {
			$classes[] = 'has-format';
		}
	}

	return $classes;
}


/**
 * Add additional context for archive title.
 *
 * @since 3.0.0
 *
 * @param string $title Archive title.
 * @return string
 */
function tamatebako_archive_title( $title ) {
	// Blog page.
	if ( is_home() && ! is_front_page() ) {
		$title = get_post_field( 'post_title', get_queried_object_id() );
	}

	// Search result page.
	if ( is_search() ) {
		$title = tamatebako_string( 'search_title_prefix' ) . sprintf( " &#8220;%s&#8221;", get_search_query() );
	}
	return $title;
}

/**
 * Add additional archive description.
 *
 * @since 1.0.0
 *
 * @param string $desc Archive description.
 * @return string
 */
function tamatebako_archive_description( $desc ) {
	// Author page.
	if ( is_author() ) {
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	} elseif ( is_post_type_archive() ) { // CPT Archive.
		$desc = get_post_type_object( get_query_var( 'post_type' ) )->description;
	}

	// Add paragraph tags.
	if( ! empty( $desc ) ) {
		return wpautop( $desc );
	}

	return $desc;
}

/**
 * Add '(Untitled)' title if not entry title is set.
 *
 * @since 1.0.0
 *
 * @param string $title Post title.
 * @return string
 */
function tamatebako_untitled_entry_title( $title ) {
	if ( empty( $title ) && ! is_singular() && in_the_loop() && ! is_admin() ) {
		$title = tamatebako_string( 'untitled' );
	}
	return $title;
}

/**
 * Adds microdata to the author posts link.
 *
 * @since  3.0.0
 * @author Justin Tadlock <justintadlock@gmail.com>
 *
 * @param  string  $link HTML link.
 * @return string
 */
function tamatebako_the_author_posts_link( $link ) {
	$pattern = array(
		"/(<a.*?)(>)/i",
		'/(<a.*?>)(.*?)(<\/a>)/i'
	);
	$replace = array(
		'$1 class="url fn n"$2',
		'$1<span class="author-name">$2</span>$3'
	);

	return preg_replace( $pattern, $replace, $link );
}

/**
 * Default Excerpt More
 * Add more link to excerpt add template function "tamatebako_read_more()" after "the_excerpt()".
 *
 * @since 0.1.0
 *
 * @param string $more Read more link.
 * @return string
 */
function tamatebako_excerpt_more( $more ) {
	return " &hellip; ";
}

/**
 * Content More
 * use the same markup as "tamatebako_read_more()" template function.
 *
 * @since  0.1.0
 *
 * @param string $more_link      More link.
 * @param string $more_link_text More link text.
 * @return string
 */
function tamatebako_content_more( $more_link, $more_link_text ) {
	$string = tamatebako_string( 'read_more' );
	if ( ! empty( $string ) ) {
		return '<span class="more-link-wrap">' . str_replace( $more_link_text, '<span class="more-text">' . $string . '</span> <span class="screen-reader-text">' . get_the_title() . '</span>', $more_link ) . '</span>';
	}
	return $more_link;
}

/**
 * WP Link Pages
 * Add class to paragraph tag for easier styling.
 *
 * @since 0.1.0
 *
 * @param array $args WP Link Pages Args.
 * @return string
 */
function tamatebako_wp_link_pages( $args ) {
	$args['before'] = '<p class="wp-link-pages">';
	$args['after'] = '</p>';
	return $args;
}

/**
 * Wraps page "links" that aren't actually links (just text) with `<span class="page-numbers">` so that they 
 * can also be styled.  This makes `wp_link_pages()` consistent with the output of `paginate_links()`.
 *
 * @since 0.1.0
 * @author Justin Tadlock <justintadlock@gmail.com>
 *
 * @param string $link Link pages link.
 * @return string
 */
function tamatebako_wp_link_pages_link( $link ) {
	if ( 0 !== strpos( $link, '<a' ) ) {
		$link = "<span class='page-numbers'>{$link}</span>";
	}
	return $link;
}

/**
 * Wraps edit post link text with span.
 *
 * @since 3.1.5
 *
 * @param string $link Link.
 * @param int    $id   Post ID.
 * @param string $text Edit anchor text.
 * @return string
 */
function tamatebako_edit_post_link( $link, $id, $text ) {
	$class = 'post-edit-link';
	$url   = get_edit_post_link( $id );
	$text  = '<span class="post-edit-link-text">' . $text . '</span>';
	$link  = '<a class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '">' . $text . '</a>';
	return $link;
}

/**
 * Comment Forms Defaults
 *
 * @since 3.2.0
 *
 * @param array $defaults Comment form default args.
 * @return array
 */
function tamatebako_comment_form_defaults( $defaults ) {
	$defaults['title_reply'] = '<span>' . $defaults['title_reply'] . '</span>';
	$defaults['title_reply_to'] = '<span>' . $defaults['cancel_reply_link'] . '</span>';
	$defaults['cancel_reply_link'] = '<span>' . $defaults['cancel_reply_link'] . '</span>';
	return $defaults;
}

/**
 * Adds microdata to the comment author link.
 *
 * @since  3.0.0
 * @author Justin Tadlock <justintadlock@gmail.com>
 *
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
 *
 * @since  3.0.0
 * @author Justin Tadlock <justintadlock@gmail.com>
 *
 * @param  string  $link Link.
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

/**
 * Load SVG Sprite in Footer.
 *
 * @since 3.5.0
 */
function tamatebako_svg_sprite_load() {
	$icons = apply_filters( 'tamatebako_svg_sprites', array() );

	if ( ! $icons || ! is_array( $icons ) ) {
		return false;
	}

	foreach ( $icons as $id => $file ) {
		if ( file_exists( $file ) ) {
			require_once( $file );
		}
	}
}
