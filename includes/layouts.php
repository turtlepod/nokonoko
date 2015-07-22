<?php
/**
 * Layouts Setup
**/
$image_dir = get_template_directory_uri() . '/assets/images/layouts/';
$layouts = array(
	/* One Column */
	'content' => array(
		'name'          => _x( 'Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content.png',
	),
	/* Two Columns */
	'content-sidebar1'  => array(
		'name'          => _x( 'Content | Sidebar 1', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content-sidebar1.png',
	),
	'sidebar1-content'  => array(
		'name'          => _x( 'Sidebar 1 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'sidebar1-content.png',
	),
	'content-sidebar2'  => array(
		'name'          => _x( 'Content | Sidebar 2', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content-sidebar2.png',
	),
	'sidebar2-content'  => array(
		'name'          => _x( 'Sidebar 2 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'sidebar2-content.png',
	),
	/* Three Columns */
	'sidebar2-content-sidebar1' => array(
		'name'          => _x( 'Sidebar 2 | Content | Sidebar 1', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'sidebar2-content-sidebar1.png',
	),
	'sidebar2-sidebar1-content' => array(
		'name'          => _x( 'Sidebar 2 | Sidebar 1 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'sidebar2-sidebar1-content.png',
	),
	'content-sidebar1-sidebar2' => array(
		'name'          => _x( 'Content | Sidebar 1 | Sidebar 2', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content-sidebar1-sidebar2.png',
	),
	'sidebar1-content-sidebar2' => array(
		'name'          => _x( 'Sidebar 1 | Content | Sidebar 2', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'sidebar1-content-sidebar2.png',
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
