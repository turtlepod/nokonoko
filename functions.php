<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load base theme functionality. */
require_once( trailingslashit( get_template_directory() ) . 'tamatebako/tamatebako.php' );

/* Load theme general setup */
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * General Setup
 */
function nokonoko_theme_setup(){

	/* Tamatebako */
	global $tamatebako;

	/* === Translation === */
	load_theme_textdomain( 'nokonoko', get_template_directory() . '/languages' );

	/* Make all string in the framework translatable. */
	$texts = array();

	/* layouts/ */
	$texts['default'] = _x( 'Default', 'layout', 'nokonoko' );
	$texts['layout'] = _x( 'Layout', 'layout', 'nokonoko' );
	$texts['global_layout'] = _x( 'Global Layout', 'layout', 'nokonoko' );

	/* template/accessibility.php */
	$texts['skip_to_content'] = _x( 'Skip to content', 'accessibility', 'nokonoko' );

	/* template/general.php */
	$texts['next_posts'] = _x( 'Next', 'pagination', 'nokonoko' );
	$texts['previous_posts'] = _x( 'Previous', 'pagination', 'nokonoko' );
	$texts['search_title_prefix'] = _x( 'Search results for', 'archive title', 'nokonoko' );

	/* template/menu.php */
	$texts['menu_search_placeholder'] = _x( 'Search&hellip;', 'nav menu', 'nokonoko' );
	$texts['menu_search_button'] = _x( 'Search', 'nav menu', 'nokonoko' );
	$texts['menu_search_form_toggle'] = _x( 'Expand Search Form', 'nav menu', 'nokonoko' );

	/* template/entry.php */
	$texts['error_title'] = _x( '404 Not Found', 'entry', 'nokonoko' );
	$texts['error_message'] = _x( 'Apologies, but no entries were found.', 'entry', 'nokonoko' );
	$texts['next_post'] = _x( 'Next', 'entry', 'nokonoko' );
	$texts['previous_post'] = _x( 'Previous', 'entry', 'nokonoko' );
	$texts['permalink'] = _x( 'Permalink', 'entry', 'nokonoko' );

	/* template/comment.php */
	$texts['next_comment'] = _x( 'Next', 'comment', 'nokonoko' );
	$texts['previous_comment'] = _x( 'Previous', 'comment', 'nokonoko' );
	$texts['comments_closed_pings_open'] = _x( 'Comments are closed, but trackbacks and pingbacks are open.', 'comment', 'nokonoko' );
	$texts['comments_closed'] = _x( 'Comments are closed.', 'comment', 'nokonoko' );

	/* functions/setup.php */
	$texts['read_more'] = _x( 'Read More', 'entry', 'nokonoko' );

	/* Add text to tamatebako */
	foreach( $texts as $text_key => $text ){
		$tamatebako->strings[$text_key] = $text;
	}

	/* === Post Formats === */
	$post_formats_args = array(
		'aside',
		'image',
		'gallery',
		'link',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
	);
	add_theme_support( 'post-formats', $post_formats_args );

	/* === Tamatebako: Customizer Mobile View === */
	add_theme_support( 'tamatebako-customize-mobile-view' );

	/* === Maximum Content Width === */
	$GLOBALS['content_width'] = 1100;

	/* === Tamatebako: Theme Layouts === */
	$image_dir = get_template_directory_uri() . '/images/layouts/';
	$layouts = array(
		/* One Column */
		'content' => array(
			'name'          => _x( 'Content', 'layout name', 'nokonoko' ),
			'content_width' => 1100,
			'thumbnail'     => $image_dir . 'layout-content.png',
		),
		/* Two Columns */
		'content-sidebar1' => array(
			'name'          => _x( 'Content | Sidebar 1', 'layout name', 'nokonoko' ),
			'content_width' => 760,
			'thumbnail'     => $image_dir . 'layout-content-sidebar1.png',
		),
		'sidebar1-content' => array(
			'name'          => _x( 'Sidebar 1 | Content', 'layout name', 'nokonoko' ),
			'content_width' => 760,
			'thumbnail'     => $image_dir . 'layout-sidebar1-content.png',
		),
		'content-sidebar2' => array(
			'name'          => _x( 'Content | Sidebar 2', 'layout name', 'nokonoko' ),
			'content_width' => 900,
			'thumbnail'     => $image_dir . 'layout-content-sidebar2.png',
		),
		'sidebar2-content' => array(
			'name'          => _x( 'Sidebar 2 | Content', 'layout name', 'nokonoko' ),
			'content_width' => 900,
			'thumbnail'     => $image_dir . 'layout-sidebar2-content.png',
		),
		/* Three Columns */
		'sidebar2-content-sidebar1' => array(
			'name'          => _x( 'Sidebar 2 | Content | Sidebar 1', 'layout name', 'nokonoko' ),
			'content_width' => 560,
			'thumbnail'     => $image_dir . 'layout-sidebar2-content-sidebar1.png',
		),
		'sidebar2-sidebar1-content' => array(
			'name'          => _x( 'Sidebar 2 | Sidebar 1 | Content', 'layout name', 'nokonoko' ),
			'content_width' => 560,
			'thumbnail'     => $image_dir . 'layout-sidebar2-sidebar1-content.png',
		),
		'content-sidebar1-sidebar2' => array(
			'name'          => _x( 'Content | Sidebar 1 | Sidebar 2', 'layout name', 'nokonoko' ),
			'content_width' => 560,
			'thumbnail'     => $image_dir . 'layout-content-sidebar1-sidebar2.png',
		),
		'sidebar1-content-sidebar2' => array(
			'name'          => _x( 'Sidebar 1 | Content | Sidebar 2', 'layout name', 'nokonoko' ),
			'content_width' => 560,
			'thumbnail'     => $image_dir . 'layout-sidebar1-content-sidebar2.png',
		),
	);
	$layouts_args = array(
		'default'     => 'sidebar2-content-sidebar1',
		'customize'   => true,
		'post_meta'   => true,
		'thumbnail'   => true,
		'post_types'  => array( 'post', 'page' ),
	);
	add_theme_support( 'tamatebako-layouts', $layouts, $layouts_args );

	/* === Tamatebako: Register Sidebars === */
	$sidebars_args = array(
		"primary" => array( "name" => _x( 'Primary Sidebar', 'sidebar name', 'nokonoko' ), "description" => "" ),
		"secondary" => array( "name" => _x( 'Secondary Sidebar', 'sidebar name', 'nokonoko' ), "description" => "" ),
	);
	add_theme_support( 'tamatebako-sidebars', $sidebars_args );

	/* === Register Menus === */
	$nav_menus_args = array(
		"primary" => _x( 'Navigation', 'nav menu name', 'nokonoko' ),
		"footer" => _x( 'Footer Links', 'nav menu name', 'nokonoko' ),
	);
	register_nav_menus( $nav_menus_args );

	/* === Custom Background === */
	$custom_backgound_args = array(
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
	);
	//add_theme_support( 'custom-background', $custom_backgound_args );

	/* === Custom Header Image === */
	$custom_header_args = array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
	);
	//add_theme_support( 'custom-header', $custom_header_args );

	/* === Tamatebako: Register Scripts === */

	/* === JS === */
	$register_js_scripts = array(
		"theme-webfontloader" => array(
			'src' => tamatebako_theme_file( 'js/webfontloader', 'js' ),
			'deps'=> array(),
		),
		"theme-imagesloaded" => array(
			'src' => tamatebako_theme_file( 'js/imagesloaded', 'js' ),
			'deps'=> array(),
		),
		"theme-flexslider" => array(
			'src' => tamatebako_theme_file( 'js/flexslider', 'js' ),
			'deps'=> array( 'jquery' ),
		),
		"theme-fitvids" => array(
			'src' => tamatebako_theme_file( 'js/fitvids', 'js' ),
			'deps'=> array( 'jquery' ),
		),
		"theme-js" => array(
			'src' => tamatebako_theme_file( 'js/theme', 'js' ),
			'deps'=> array( 'jquery', 'theme-fitvids' ),
		),
		"child-theme-js" => array(
			'src' => tamatebako_child_theme_file( 'js/child-theme', 'js' ),
			'deps'=> array( 'jquery' ),
		),
	);
	add_theme_support( 'tamatebako-register-js', $register_js_scripts );

	/* === CSS === */
	$register_css_scripts = array(
		"theme-open-sans-font" => array(
			'src' => add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
		),
		"theme-merriweather-font" => array(
			'src' => add_query_arg( 'family', urlencode( 'Merriweather:400,300italic,300,400italic,700,700italic,900,900italic' ), "//fonts.googleapis.com/css" ),
		),
		"theme-flexslider" => array(
			'src' => tamatebako_theme_file( 'css/flexslider', 'css' ),
		),
		"theme-reset" => array(
			'src' => tamatebako_theme_file( 'css/reset', 'css' ),
		),
		"theme-layouts" => array(
			'src' => tamatebako_theme_file( 'css/layouts', 'css' ),
		),
		"theme-menus" => array(
			'src' => tamatebako_theme_file( 'css/menus', 'css' ),
		),
		"theme-comments" => array(
			'src' => tamatebako_theme_file( 'css/comments', 'css' ),
		),
		"theme-widgets" => array(
			'src' => tamatebako_theme_file( 'css/widgets', 'css' ),
		),
		"theme" => array(
			'src' => tamatebako_theme_file( 'css/theme', 'css' ),
		),
		"media-queries" => array(
			'src' => tamatebako_theme_file( 'css/media-queries', 'css' ),
		),
		"debug-media-queries" => array(
			'src' => tamatebako_theme_file( 'css/debug-media-queries', 'css' ),
		),
		"style" => array(
			'src' => tamatebako_theme_file( 'style', 'css' ),
		),
		"child" => array(
			'src' => tamatebako_child_theme_file( 'style', 'css' ),
		),
	);
	add_theme_support( 'tamatebako-register-css', $register_css_scripts );

	/* === Tamatebako: Enqueue Script (JS) === */
	$enqueue_js_scripts = array(
		"theme-fitvids"              => array( 'registered' => true ),
		"theme-js"                   => array( 'registered' => true ),
		"child-theme-js"             => array( 'registered' => true ),
	);
	add_theme_support( 'tamatebako-enqueue-js', $enqueue_js_scripts );

	/* === Tamatebako: Enqueue Style (CSS) === */
	$enqueue_css_scripts = array(
		"theme-open-sans-font"       => array( 'registered' => true ),
		//"theme-merriweather-font"    => array( 'registered' => true ),
		"dashicons"                  => array( 'registered' => true ),
		"theme-reset"                => array( 'registered' => true ),
		"theme-layouts"              => array( 'registered' => true ),
		"theme-menus"                => array( 'registered' => true ),
		"theme-comments"             => array( 'registered' => true ),
		"theme-widgets"              => array( 'registered' => true ),
		"theme"                      => array( 'registered' => true ),
		"media-queries"              => array( 'registered' => true ),
		"debug-media-queries"        => array( 'registered' => true ),
		//"style"                      => array( 'registered' => true ),
		"child"                      => array( 'registered' => true ),
	);
	add_theme_support( 'tamatebako-enqueue-css', $enqueue_css_scripts );

	/* === Editor Style === */
	$editor_css = array(
		add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
		'css/reset.min.css',
		'css/editor.css'
	);
	add_editor_style( $editor_css );

}

do_action( 'tamatebako_after_theme_setup' );