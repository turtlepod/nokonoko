<?php
/**
 * Setup Theme Elements & Assets
 *
 * - Content width.
 * - Register sidebars.
 * - Register menus.
 * - Image sizes & thumbnails.
 * - Post formats.
 * - Body classes.
 * - Editor style.
 * - Scripts.
 *
 * @since 1.0.0
 * @author GenbuMedia
**/

/* === CONTENT WIDTH === */

global $content_width;
if ( ! isset( $content_width ) ){
	$content_width = 1100;
}


/* === REGISTER SIDEBAR === */

$sidebars_args = array(
	'primary' => array(
		'name'        => _x( 'Primary Sidebar', 'sidebar name', 'nokonoko' ),
		'description' => '',
	),
);
add_theme_support( 'tamatebako-sidebars', $sidebars_args );


/* === REGISTER MENUS === */

$nav_menus_args = array(
	'primary' => _x( 'Navigation', 'nav menu name', 'nokonoko' ),
	'footer'  => _x( 'Footer Links', 'nav menu name', 'nokonoko' ),
	'social'  => _x( 'Social Links', 'nav menu name', 'nokonoko' ),
);
register_nav_menus( $nav_menus_args );


/* === IMAGE SIZES & THUMBNAILS === */

//add_image_size( 'theme-thumbnail', 300, 200, true );
//set_post_thumbnail_size( 200, 200, true );


/* === POST FORMATS === */

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
add_theme_support( 'post-formats', $post_formats_args );


/* === BODY CLASSES === */

/**
 * Add Body Classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Body classes.
 * @return array
 */
add_filter( 'body_class', function( $classes ) {
	//$classes[] = 'stuff';
	return $classes;
} );


/* === EDITOR STYLE === */

$editor_css = array(
	tamatebako_google_fonts_url( array(
		'Open Sans' => '400,400italic,700,700italic,800,800italic',
	) ),
	'assets/theme/editor.css',
	'assets/library/esicons/fonts.css',
);
add_editor_style( $editor_css );


/* === SCRIPTS === */

add_action( 'wp_enqueue_scripts', function() {
	global $tamatebako;
	$name    = $tamatebako->name;
	$child   = $tamatebako->child;
	$version = tamatebako_is_debug() ? time() : tamatebako_theme_version();

	/* = REGISTER = */

	// FitVids.
	wp_register_script( 'fitvids', tamatebako_theme_file( 'assets/library/fitvids/jquery.fitvids', 'js' ) , array( 'jquery' ), '1.1.0', true );

	// Flexslider.
	//wp_register_script( 'flexslider', tamatebako_theme_file( 'assets/library/flexslider/jquery.flexslider', 'js' ), array( 'jquery' ), '2.5.0', true );
	//wp_register_style( 'flexslider', tamatebako_theme_file( 'assets/flexslider/flexslider', 'css' ), array(), '2.5.0', 'all' );

	// WebFontLoader.
	//wp_register_script( 'webfontloader', tamatebako_theme_file( 'assets/library/webfontloader', 'js' ), array(), '1.5.3', true );

	// ImagesLoaded.
	//wp_register_script( 'imagesloaded', tamatebako_theme_file( 'assets/library/jquery.imagesloaded', 'js' ), array( 'jquery' ), '3.1.8', true );

	// Google Fonts.
	//wp_register_style( "{$name}-google-fonts", tamatebako_google_fonts_url( array(
	//	'Open Sans' => '400,400italic,700,700italic,800,800italic',
	//) ), array(), $version );

	// Theme.
	wp_register_script( "{$name}-script", tamatebako_theme_file( 'assets/theme/theme.min', 'js' ), array( 'jquery', 'fitvids' ), $version, true );
	$data = array();
	wp_localize_script( "{$name}-script", 'tamatebako', $data );

	/* = ENQUEUE = */

	wp_enqueue_script( "{$name}-script" );
	wp_enqueue_style( "{$name}-style" );
	if ( is_child_theme() ) {
		wp_enqueue_style( "{$child}-style" );
	}

	// Debug
	if ( tamatebako_is_debug() ) {
		wp_enqueue_style( "{$name}-debug", tamatebako_theme_file( 'assets/theme/debug', 'css' ), array(), $version );
	}

}, 1 );