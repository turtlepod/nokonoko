<?php
/**
 * Layouts Setup
**/

/* === Register Sidebars === */

$sidebars_args = array(
	"primary"   => array( "name" => _x( 'Primary Sidebar', 'sidebar name', 'nokonoko' ), "description" => "" ),
	"secondary" => array( "name" => _x( 'Secondary Sidebar', 'sidebar name', 'nokonoko' ), "description" => "" ),
);
add_theme_support( 'tamatebako-sidebars', $sidebars_args );


/* === Register Menus === */

$nav_menus_args = array(
	"primary" => _x( 'Navigation', 'nav menu name', 'nokonoko' ),
	"footer" => _x( 'Footer Links', 'nav menu name', 'nokonoko' ),
);
register_nav_menus( $nav_menus_args );


/* === Maximum Content Width === */

$GLOBALS['content_width'] = 1100;


/* === Thumbnail Size === */

//add_image_size( 'theme-thumbnail', 300, 200, true );
//set_post_thumbnail_size( 200, 200, true );

/* === Theme Layouts === */

$image_dir = get_template_directory_uri() . '/assets/images/layouts/';
$layouts = array(
	/* One Column */
	'content' => array(
		'name'          => _x( 'Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-content.png',
	),
	/* Two Columns */
	'content-sidebar1'  => array(
		'name'          => _x( 'Content | Sidebar 1', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-content-sidebar1.png',
	),
	'sidebar1-content'  => array(
		'name'          => _x( 'Sidebar 1 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-sidebar1-content.png',
	),
	'content-sidebar2'  => array(
		'name'          => _x( 'Content | Sidebar 2', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-content-sidebar2.png',
	),
	'sidebar2-content'  => array(
		'name'          => _x( 'Sidebar 2 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-sidebar2-content.png',
	),
	/* Three Columns */
	'sidebar2-content-sidebar1' => array(
		'name'          => _x( 'Sidebar 2 | Content | Sidebar 1', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-sidebar2-content-sidebar1.png',
	),
	'sidebar2-sidebar1-content' => array(
		'name'          => _x( 'Sidebar 2 | Sidebar 1 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-sidebar2-sidebar1-content.png',
	),
	'content-sidebar1-sidebar2' => array(
		'name'          => _x( 'Content | Sidebar 1 | Sidebar 2', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-content-sidebar1-sidebar2.png',
	),
	'sidebar1-content-sidebar2' => array(
		'name'          => _x( 'Sidebar 1 | Content | Sidebar 2', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'layout-sidebar1-content-sidebar2.png',
	),
);
$layouts_args = array(
	'default'           => 'sidebar2-content-sidebar1',
	'customize'         => true,
	'post_meta'         => true,
	'post_types'        => array( 'post' ),
	'thumbnail'         => true,
);
$layouts_strings = array(
	'default'           => _x( 'Default', 'layout', 'nokonoko' ),
	'layout'            => _x( 'Layout', 'layout', 'nokonoko' ),
	'global_layout'     => _x( 'Global Layout', 'layout', 'nokonoko' ),
);
add_theme_support( 'tamatebako-layouts', $layouts, $layouts_args, $layouts_strings );

