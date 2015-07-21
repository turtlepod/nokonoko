<?php
/**
 * Scripts Setup
**/

/* === ENQUEUE JS === */

$enqueue_js_scripts = array(
	"theme-fitvids"              => array( 'registered' => true ),
	"theme-js"                   => array( 'registered' => true ),
	"child-theme-js"             => array( 'registered' => true ),
);
add_theme_support( 'tamatebako-enqueue-js', $enqueue_js_scripts );


/* === ENQUEUE CSS === */

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
	//"debug-media-queries"        => array( 'registered' => true ),
	//"style"                      => array( 'registered' => true ),
	"child"                      => array( 'registered' => true ),
);
add_theme_support( 'tamatebako-enqueue-css', $enqueue_css_scripts );

/* === EDITOR STYLE === */

$editor_css = array(
	add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
	'css/reset.min.css',
	'css/editor.css'
);
add_editor_style( $editor_css );


/* === REGISTER JS === */

$register_js_scripts = array(
	"theme-webfontloader" => array(
		'src' => tamatebako_theme_file( 'js/webfontloader', 'js' ),
	),
	"theme-imagesloaded" => array(
		'src' => tamatebako_theme_file( 'js/imagesloaded', 'js' ),
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


/* === REGISTER CSS === */

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


