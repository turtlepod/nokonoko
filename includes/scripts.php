<?php
/**
 * Scripts Setup
**/

/* === BODY CLASSES === */

add_filter( 'body_class', 'nokonoko_scripts_body_class' );

/**
 * Scripts Body Class Helper
 */
function nokonoko_scripts_body_class( $classes ){
	$classes[] = 'theme-genericons-active';
	return $classes;
}

/* === EDITOR STYLE === */

$editor_css = array(
	//tamatebako_google_fonts_url( array( 'Open Sans' => '400,400italic,700,700italic,800,800italic' ) ),
	'assets/css/editor.css',
);
add_editor_style( $editor_css );


/* === ENQUEUE SCRIPTS === */

add_action( 'wp_enqueue_scripts', 'nokonoko_enqueue_scripts' );

/**
 * Enqueue Scripts
 */
function nokonoko_enqueue_scripts(){

	/* == JS == */
	wp_enqueue_script( 'fitvids' );
	wp_enqueue_script( 'nokonoko-js' );

	/* == CSS == */
	//wp_enqueue_style( 'nokonoko-google-fonts' );
	//wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'genericons' );
	wp_enqueue_style( 'parent' );
	wp_enqueue_style( 'style' );
	wp_enqueue_style( 'tamatebako-debug' );
}


/* === REGISTER SCRIPTS === */

add_action( 'wp_enqueue_scripts', 'nokonoko_register_scripts', 1 );

/**
 * Register Scripts
 */
function nokonoko_register_scripts(){

	/* FitVids (JS) */
	wp_register_script( 'fitvids', tamatebako_theme_file( "assets/js/jquery.fitvids", "js" ) , array( 'jquery' ), '1.1.0', true );

	/* Flexslider (JS) */
	wp_register_script( 'flexslider', tamatebako_theme_file( "assets/flexslider/jquery.flexslider", "js" ), array( 'jquery' ), '2.5.0', true );

	/* Flexslider (CSS) */
	wp_register_style( 'flexslider', tamatebako_theme_file( "assets/flexslider/flexslider", "css" ), array(), '2.5.0', 'all' );

	/* WebFontLoader (JS) */
	wp_register_script( 'webfontloader', tamatebako_theme_file( "assets/js/webfontloader", "js" ), array(), '1.5.3', true );

	/* ImagesLoaded (JS) */
	wp_register_script( 'imagesloaded', tamatebako_theme_file( "assets/js/jquery.imagesloaded", "js" ), array( 'jquery' ), '3.1.8', true );

	/* Theme Custom (JS) */
	wp_register_script( 'nokonoko-js', tamatebako_theme_file( "assets/js/jquery.theme", "js" ), array( 'jquery', 'fitvids' ), tamatebako_theme_version(), true );

	/* === CSS === */

	/* Google Fonts */
	wp_register_style( 'nokonoko-google-fonts', tamatebako_google_fonts_url( array( 'Open Sans' => '400,400italic,700,700italic,800,800italic' ) ) );

	/* Genericons */
	wp_register_style( 'genericons', tamatebako_theme_file( "assets/genericons/genericons", "css" ), array(), '3.3.1', 'all' );

	/* Theme Debug */
	if( tamatebako_is_debug() ) wp_register_style( 'tamatebako-debug', tamatebako_theme_file( "assets/css/base/debug", "css" ), array() );

}
