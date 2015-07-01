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
	load_theme_textdomain( 'nokonoko', get_template_directory() . '/languages' );


	/* === Content Width === */
	$GLOBALS['content_width'] = 640;


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
		'chat'
	);
	//add_theme_support( 'post-formats', $post_formats_args );


	/* === Tamatebako: Customizer Mobile View === */
	add_theme_support( 'tamatebako-customize-mobile-view' );


	/* === Tamatebako: Theme Layouts === */
	$layouts = array(
		'content' => 'One Column',
		'content-sidebar1' => 'Two Columns',
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
	register_nav_menus( array(
		"primary" => 'Navigation',
		"footer" => 'Footer Links',
	) );


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


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
}


























do_action( 'nokonoko_after_theme_setup' );