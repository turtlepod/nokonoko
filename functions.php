<?php
/**
 * Theme Functions
** ---------------------------- */

/* Load base theme functionality. */
require_once( trailingslashit( get_template_directory() ) . 'tamatebako/core.php' );

/* Make Tamatebako text string translateable */
add_filter( 'tamatebako_strings', 'nokonoko_string' );

/**
 * Text String Used in Theme.
 * @since 1.0.0
 */
function nokonoko_string( $texts ){

	/* === Tamatebako === */

	/* Layouts */
	$texts['Default'] = __( 'Default', 'nokonoko' );
	$texts['Layout'] = __( 'Layout', 'nokonoko' );
	$texts['Global Layout'] = __( 'Global Layout', 'nokonoko' );

	/* === Theme === */
	

	return $texts;
}


/* Load theme general setup */
add_action( 'after_setup_theme', 'nokonoko_theme_setup', 5 );

/**
 * General Setup
 * @since 1.0.0
 */
function nokonoko_theme_setup(){

	/* === Translation === */
	load_theme_textdomain( 'nokonoko', get_template_directory() . '/languages' );


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
	$GLOBALS['content_width'] = 940;


	/* === Tamatebako: Theme Layouts === */
	$layouts = array(
		'content' => array(
			'name' => 'One Column',
			'content_width' => 940,
		),
		'content-sidebar1' => array(
			'name' => 'Two Columns',
			'content_width' => 640,
		),
	);
	$layouts_args = array(
		'default'   => 'content-sidebar1',
		'customize' => true,
		'post_meta' => true,
	);
	add_theme_support( 'tamatebako-layouts', $layouts, $layouts_args );


	/* === Tamatebako: Register Sidebars === */
	$sidebars_args = array(
		"primary" => array( "name" => 'Primary', "description" => "" ),
		"secondary" => array( "name" => 'Secondary', "description" => "" ),
	);
	add_theme_support( 'tamatebako-sidebars', $sidebars_args );


	/* === Register Menus === */
	$nav_menus_args = array(
		"primary" => 'Navigation',
		"footer" => 'Footer Links',
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


	/* === Tamatebako: Register Script (JS) === */
	$register_js_scripts = array(
		"fitvids" => array(
			'src' => tamatebako_theme_file( 'js/fitvids', 'js' ),
			'deps'=> array( 'jquery' ),
		),
		"theme" => array(
			'src' => tamatebako_theme_file( 'js/theme', 'js' ),
			'deps'=> array( 'jquery', 'fitvids' ),
		),
	);
	add_theme_support( 'tamatebako-register-js', $register_js_scripts );


	/* === Tamatebako: Enqueue Script (JS) === */
	$enqueue_js_scripts = array(
		"fitvids" => array( 'registered' => true ),
		"theme" => array( 'registered' => true ),
	);
	add_theme_support( 'tamatebako-enqueue-js', $enqueue_js_scripts );


	/* === Tamatebako: Register Style (CSS) === */
	$register_css_scripts = array(
		"theme-open-sans-font" => array(
			'src' => add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
		),
		"theme-merriweather-font" => array(
			'src' => add_query_arg( 'family', urlencode( 'Merriweather:400,300italic,300,400italic,700,700italic,900,900italic' ), "//fonts.googleapis.com/css" ),
		),
		"reset" => array(
			'src' => tamatebako_theme_file( 'css/reset', 'css' ),
		),
		"menus" => array(
			'src' => tamatebako_theme_file( 'css/menus', 'css' ),
		),
		"theme" => array(
			'src' => tamatebako_theme_file( 'css/theme', 'css' ),
		),
		"media-queries" => array(
			'src' => tamatebako_theme_file( 'css/media-queries', 'css' ),
		),
		"style" => array(
			'src' => tamatebako_theme_file( 'style', 'css' ),
		),
		"child" => array(
			'src' => tamatebako_child_theme_file( 'style', 'css' ),
		),
	);
	add_theme_support( 'tamatebako-register-css', $register_css_scripts );


	/* === Tamatebako: Enqueue Style (CSS) === */
	$enqueue_css_scripts = array(
		"theme-open-sans-font" => array( 'registered' => true ),
		"dashicons" => array( 'registered' => true ),
		"reset" => array( 'registered' => true ),
		"menus" => array( 'registered' => true ),
		"theme" => array( 'registered' => true ),
		"media-queries" => array( 'registered' => true ),
		//"style" => array( 'registered' => true ),
		"child" => array( 'registered' => true ),
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




do_action( 'nokonoko_after_theme_setup' );