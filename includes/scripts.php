<?php
/**
 * Register Scripts
 * @since 1.0.0
**/

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
		'deps'=> array( 'jquery', 'fitvids' ),
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


