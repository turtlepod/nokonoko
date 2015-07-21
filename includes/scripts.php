<?php
/**
 * Scripts Setup
**/
add_action( 'wp_enqueue_scripts', 'nokonoko_scripts' );

/**
 * Enqueue Scripts
 */
function nokonoko_scripts(){

	/* == CONDITIONAL == */
	if( !is_singular() ){
		//wp_enqueue_script( 'masonry' );
		//wp_enqueue_style( 'masonry' );
		//wp_enqueue_script( 'theme-imagesloaded' );
		//wp_enqueue_script( 'theme-webfontloader' );
	}
	if( is_page() && is_front_page() ){
		//wp_enqueue_script( 'theme-flexslider' );
		//wp_enqueue_style( 'theme-flexslider' );
	}

	/* == JS == */
	wp_enqueue_script( 'theme-fitvids' );
	wp_enqueue_script( 'theme-js' );

	/* == CSS == */
	wp_enqueue_style( 'theme-open-sans-font' );
	wp_enqueue_style( 'dashicons' );
	$debug = true;
	if ( isset( $debug ) && $debug ){
		wp_enqueue_style( 'theme-reset' );
		wp_enqueue_style( 'theme-menus' );
		wp_enqueue_style( 'theme-layouts' );
		wp_enqueue_style( 'theme-comments' );
		wp_enqueue_style( 'theme' );
		wp_enqueue_style( 'media-queries' );
		wp_enqueue_style( 'debug-media-queries' );
	}
	else{
		wp_enqueue_style( 'style' );
	}
	if( is_child_theme() ) wp_enqueue_style( 'child' );
}


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
		'src'        => tamatebako_theme_file( 'assets/js/webfontloader', 'js' ),
	),
	"theme-imagesloaded" => array(
		'src'        => tamatebako_theme_file( 'assets/js/imagesloaded', 'js' ),
	),
	"theme-flexslider" => array(
		'src'        => tamatebako_theme_file( 'assets/js/flexslider', 'js' ),
		'deps'       => array( 'jquery' ),
	),
	"theme-fitvids" => array(
		'src'        => tamatebako_theme_file( 'assets/js/fitvids', 'js' ),
		'deps'       => array( 'jquery' ),
	),
	/* Theme */
	"theme-js" => array(
		'src'        => tamatebako_theme_file( 'assets/js/theme', 'js' ),
		'deps'       => array( 'jquery', 'theme-fitvids' ),
		'ver'        => tamatebako_theme_version(),
		'in_footer'  => true,
	),
	"child-theme-js" => array(
		'src'        => tamatebako_child_theme_file( 'assets/js/child-theme', 'js' ),
		'deps'       => array( 'jquery' ),
	),
);
add_theme_support( 'tamatebako-register-js', $register_js_scripts );


/* === REGISTER CSS === */

$register_css_scripts = array(
	"theme-open-sans-font" => array(
		'src'   => add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
	),
	"theme-flexslider" => array(
		'src'   => tamatebako_theme_file( 'assets/css/flexslider', 'css' ),
	),
	"theme-flexslider" => array(
		'src'   => tamatebako_theme_file( 'assets/css/genericons', 'css' ),
	),
	"theme-reset" => array(
		'src'   => tamatebako_theme_file( 'assets/css/reset', 'css' ),
	),
	"theme-layouts" => array(
		'src'   => tamatebako_theme_file( 'assets/css/layouts', 'css' ),
	),
	"theme-menus" => array(
		'src'   => tamatebako_theme_file( 'assets/css/menus', 'css' ),
	),
	"theme-comments" => array(
		'src'   => tamatebako_theme_file( 'assets/css/comments', 'css' ),
	),
	"theme-widgets" => array(
		'src'   => tamatebako_theme_file( 'assets/css/widgets', 'css' ),
	),
	"theme" => array(
		'src'   => tamatebako_theme_file( 'assets/css/theme', 'css' ),
	),
	"media-queries" => array(
		'src'   => tamatebako_theme_file( 'assets/css/media-queries', 'css' ),
	),
	"debug-media-queries" => array(
		'src'   => tamatebako_theme_file( 'assets/css/debug-media-queries', 'css' ),
	),
	/* Main Stylesheet */
	"style" => array(
		'src'   => tamatebako_theme_file( 'style', 'css' ),
		'deps'  => array(),
		'ver'   => tamatebako_theme_version(),
		'media' => 'all',
	),
	"child" => array(
		'src'   => tamatebako_child_theme_file( 'style', 'css' ),
	),
);
add_theme_support( 'tamatebako-register-css', $register_css_scripts );
