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
	'assets/css/base.min.css',
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

	/* icons and fonts */
	//wp_enqueue_style( 'nokonoko-google-fonts' );
	//wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'genericons' );

	/* Load CSS */
	$dev = tamatebako_maybe_enqueue_style( 'theme-dev' );
	if ( !$dev ){
		tamatebako_maybe_enqueue_style( 'parent' );
		wp_enqueue_style( 'style' );
	}
}


/* === REGISTER SCRIPTS === */

add_action( 'wp_enqueue_scripts', 'nokonoko_register_scripts', 1 );

/**
 * Register Scripts
 */
function nokonoko_register_scripts(){

	/* vars */
	$uri = get_template_directory_uri() . '/assets';
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$dev = defined( 'TAMATEBAKO_DEV' ) && TAMATEBAKO_DEV ? true : false;
	$ver = tamatebako_theme_version();

	/* FitVids (JS) */
	wp_register_script( 'fitvids', "{$uri}/js/jquery.fitvids{$min}.js" , array( 'jquery' ), '1.1.0', true );

	/* Flexslider (JS) */
	wp_register_script( 'flexslider', "{$uri}/flexslider/jquery.flexslider{$min}.js", array( 'jquery' ), '2.5.0', true );

	/* Flexslider (CSS) */
	wp_register_style( 'flexslider', "{$uri}/flexslider/flexslider{$min}.css", array(), '2.5.0', 'all' );

	/* WebFontLoader (JS) */
	wp_register_script( 'webfontloader', "{$uri}/js/webfontloader{$min}.js", array(), '1.5.3', true );

	/* ImagesLoaded (JS) */
	wp_register_script( 'imagesloaded', "{$uri}/js/jquery.imagesloaded{$min}.js", array( 'jquery' ), '3.1.8', true );

	/* Theme Custom (JS) */
	wp_register_script( 'nokonoko-js', "{$uri}/js/jquery.theme.js", array( 'jquery', 'fitvids' ), $ver, true );

	/* === CSS === */

	/* Google Fonts */
	wp_register_style( 'nokonoko-google-fonts', tamatebako_google_fonts_url( array( 'Open Sans' => '400,400italic,700,700italic,800,800italic' ) ), array(), $ver,'all' );

	/* Genericons */
	wp_register_style( 'genericons', "{$uri}/fonts/genericons/genericons.css", array(), '3.3.1', 'all' );

	if ( $dev ){

		/* Theme Debug */
		wp_register_style( 'theme-debug', "{$uri}/css/base/debug.css", array() );

		/* Theme Dev */
		wp_register_style( 'theme-dev', "{$uri}/css/dev.css", array( 'theme-debug' ), $ver, 'all' );
	}
}
