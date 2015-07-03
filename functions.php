<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load base theme functionality. */
require_once( trailingslashit( get_template_directory() ) . 'tamatebako/core.php' );


/* Load theme general setup */
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * General Setup
 * @since 1.0.0
 */
function nokonoko_theme_setup(){

	/* === Translation === */
	tamatebako_include( 'includes/strings' );

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
	//add_theme_support( 'post-formats', $post_formats_args );

	/* === Tamatebako: Customizer Mobile View === */
	add_theme_support( 'tamatebako-customize-mobile-view' );

	/* === Maximum Content Width === */
	$GLOBALS['content_width'] = 1100;

	/* === Tamatebako: Theme Layouts === */
	$layouts = array(
		/* One Column */
		'content' => array(
			'name'          => tamatebako_string( 'Content' ),
			'content_width' => 1100,
		),
		/* Two Columns */
		'content-sidebar1' => array(
			'name'          => tamatebako_string( 'Content | Sidebar 1' ),
			'content_width' => 760,
		),
		'sidebar1-content' => array(
			'name'          => tamatebako_string( 'Sidebar 1 | Content' ),
			'content_width' => 760,
		),
		'content-sidebar2' => array(
			'name'          => tamatebako_string( 'Sidebar 1 | Content' ),
			'content_width' => 900,
		),
		'sidebar2-content' => array(
			'name'          => tamatebako_string( 'Sidebar 1 | Content' ),
			'content_width' => 900,
		),
		/* Three Columns */
		'sidebar2-content-sidebar1' => array(
			'name'          => tamatebako_string( 'Sidebar 2 | Content | Sidebar 1' ),
			'content_width' => 560,
		),
		'sidebar2-sidebar1-content' => array(
			'name'          => tamatebako_string( 'Sidebar 1 | Sidebar 2 | Content' ),
			'content_width' => 560,
		),
		'content-sidebar1-sidebar2' => array(
			'name'          => tamatebako_string( 'Content | Sidebar 1 | Sidebar 2' ),
			'content_width' => 560,
		),
		'sidebar1-content-sidebar2' => array(
			'name'          => tamatebako_string( 'Sidebar 1 | Content | Sidebar 2' ),
			'content_width' => 560,
		),
	);
	$layouts_args = array(
		'default'   => 'content',
		'customize' => false,
		'post_meta' => true,
	);
	add_theme_support( 'tamatebako-layouts', $layouts, $layouts_args );

	/* === Tamatebako: Register Sidebars === */
	$sidebars_args = array(
		"primary" => array( "name" => tamatebako_string( 'Primary' ), "description" => "" ),
		"secondary" => array( "name" => tamatebako_string( 'Secondary' ), "description" => "" ),
	);
	add_theme_support( 'tamatebako-sidebars', $sidebars_args );

	/* === Register Menus === */
	$nav_menus_args = array(
		"primary" => tamatebako_string( 'Navigation' ),
		"footer" => tamatebako_string( 'Footer Links' ),
	);
	register_nav_menus( $nav_menus_args );

	/* === Custom Background === */
	$custom_backgound_args = array(
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
	);
	add_theme_support( 'custom-background', $custom_backgound_args );

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
	add_theme_support( 'custom-header', $custom_header_args );

	/* === Tamatebako: Register Scripts === */
	tamatebako_include( 'includes/scripts' );

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