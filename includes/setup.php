<?php
/**
 * Setup Theme Elements
**/

/* === Maximum Content Width === */

global $content_width;
if ( ! isset( $content_width ) ){
	$content_width = 1100;
}

/* === Register Sidebars === */

$sidebars_args = array(
	"primary"   => array( "name" => _x( 'Primary Sidebar', 'sidebar name', 'nokonoko' ), "description" => "" ),
);
add_theme_support( 'tamatebako-sidebars', $sidebars_args );


/* === Register Menus === */

$nav_menus_args = array(
	"primary" => _x( 'Navigation', 'nav menu name', 'nokonoko' ),
	"footer" => _x( 'Footer Links', 'nav menu name', 'nokonoko' ),
);
register_nav_menus( $nav_menus_args );


/* === Thumbnail Size === */

//add_image_size( 'theme-thumbnail', 300, 200, true );
//set_post_thumbnail_size( 200, 200, true );

