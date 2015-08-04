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
	add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
	'assets/css/base.min.css',
	'assets/css/editor.css',
);
add_editor_style( $editor_css );


/* === ENQUEUE SCRIPTS === */

add_action( 'wp_enqueue_scripts', 'nokonoko_scripts' );

/**
 * Enqueue Scripts
 */
function nokonoko_scripts(){

	/* == CONDITIONAL == */

	/* Plural */
	if( is_home() || is_archive() || is_search() ){
		//wp_enqueue_script( 'masonry' );
		//wp_enqueue_style( 'masonry' );
		//wp_enqueue_script( 'theme-imagesloaded' );
		//wp_enqueue_script( 'theme-webfontloader' );
	}

	/* Page as Front Page */
	if( is_page() && is_front_page() ){
		//wp_enqueue_script( 'theme-flexslider' );
		//wp_enqueue_style( 'theme-flexslider' );
	}

	/* Page Template */
	if ( is_page_template( 'templates/full-width.php' ) ) {
		//wp_enqueue_script( 'theme-flexslider' );
		//wp_enqueue_style( 'theme-flexslider' );
	}

	/* == JS == */
	wp_enqueue_script( 'theme-fitvids' );
	wp_enqueue_script( 'theme-js' );

	/* == CSS == */
	wp_enqueue_style( 'theme-open-sans' );
	//wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'theme-genericons' );
	$dev = true;
	if ( isset( $dev ) && $dev ){
		wp_enqueue_style( 'theme-base' );
		wp_enqueue_style( 'theme-menus' );
		wp_enqueue_style( 'theme-layouts' );
		wp_enqueue_style( 'theme-widgets' );
		wp_enqueue_style( 'theme-comments' );
		wp_enqueue_style( 'theme' );
		wp_enqueue_style( 'theme-media-queries' );
		wp_enqueue_style( 'debug-media-queries' );
	}
	else{
		tamatebako_maybe_enqueue_style( 'parent' );
		wp_enqueue_style( 'style' );
	}
}

/* === REGISTER JS === */

$register_js_scripts = array(
	/* Library */
	"theme-flexslider" => array(
		'src'        => tamatebako_theme_file( 'assets/flexslider/jquery.flexslider', 'js' ),
		'deps'       => array( 'jquery' ),
		'ver'        => '2.5.0',
	),
	"theme-webfontloader" => array(
		'src'        => tamatebako_theme_file( 'assets/js/webfontloader', 'js' ),
		'ver'        => '1.5.3',
	),
	"theme-imagesloaded" => array(
		'src'        => tamatebako_theme_file( 'assets/js/jquery.imagesloaded', 'js' ),
		'deps'       => array( 'jquery' ),
		'ver'        => '3.1.8',
	),
	"theme-fitvids" => array(
		'src'        => tamatebako_theme_file( 'assets/js/jquery.fitvids', 'js' ),
		'deps'       => array( 'jquery' ),
		'ver'        => '1.1.0',
	),
	/* Theme */
	"theme-js" => array(
		'src'        => tamatebako_theme_file( 'assets/js/jquery.theme', 'js' ),
		'deps'       => array( 'jquery', 'theme-fitvids' ),
		'ver'        => tamatebako_theme_version(),
		'in_footer'  => true,
	),
);
add_theme_support( 'tamatebako-register-js', $register_js_scripts );


/* === REGISTER CSS === */

$register_css_scripts = array(
	/* Font */
	"theme-open-sans" => array(
		'src'   => add_query_arg( 'family', 'Open+Sans:' . urlencode( '400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" ),
	),
	/* Icon */
	"theme-genericons" => array(
		'src'   => tamatebako_theme_file( 'assets/fonts/genericons/genericons', 'css' ),
		'ver'   => '3.3.1',
	),
	/* Library */
	"theme-flexslider" => array(
		'src'   => tamatebako_theme_file( 'assets/flexslider/flexslider', 'css' ),
		'ver'   => '2.5.0',
	),
	/* Theme */
	"theme-base" => array(
		'src'   => tamatebako_theme_file( 'assets/css/base', 'css' ),
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
	"theme-media-queries" => array(
		'src'   => tamatebako_theme_file( 'assets/css/media-queries', 'css' ),
	),
	"debug-media-queries" => array(
		'src'   => tamatebako_theme_file( 'assets/css/debug-media-queries', 'css' ),
	),
);
add_theme_support( 'tamatebako-register-css', $register_css_scripts );

