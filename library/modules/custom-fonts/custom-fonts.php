<?php
/**
 * Custom Fonts Module.
**/

/* === VARS === */

/**
 * Fonts Config Defined By Theme
 */
function tamatebako_fonts_config(){
	$theme_support = get_theme_support( 'tamatebako-custom-fonts' );
	$fonts_config = array();
	if ( isset( $theme_support[0] ) ){
		$fonts_config = $theme_support[0];
	}
	return $fonts_config;
}

/**
 * Fonts Settings
 */
function tamatebako_fonts_settings(){
	$theme_support = get_theme_support( 'tamatebako-custom-fonts' );
	$fonts_settings = array();
	if ( isset( $theme_support[1] ) ){
		$fonts_settings = $theme_support[1];
	}
	return $fonts_settings;
}

/**
 * Fonts Customizer Label
 */
function tamatebako_fonts_label(){
	$defaults = array( 
		'fonts' => 'Fonts',
	);
	$theme_support = get_theme_support( 'tamatebako-custom-fonts' );
	$args = isset( $theme_support[2] ) ? $theme_support[2] : array();
	return wp_parse_args( $args, $defaults );
}

/* === FONTS AVAILABLE === */

tamatebako_include( 'modules/custom-fonts/fonts' );

/* === UTILITY === */

tamatebako_include( 'modules/custom-fonts/utility' );

/* === CUSTOMIZER === */

tamatebako_include( 'modules/custom-fonts/customizer' );

/* === IMPLEMENTATION === */

/**
 * Return Google Font URL containing all fonts used.
 */
function tamatebako_fonts_all_google_url(){

	/* Get fonts config */
	$config = tamatebako_fonts_config();

	/* Vars: List of all fonts used */
	$fonts = array();

	/* Foreach setting */
	foreach( $config as $section => $section_data ){

		/* Get font saved. */
		$font = tamatebako_fonts_remove_websafe( get_theme_mod( $section, $section_data['default'] ) );

		if( !empty( $font ) ){
			$fonts[$font] = tamatebako_get_font_weight( $font );
		}

	}

	if( !empty( $fonts ) ){
		return tamatebako_google_fonts_url( $fonts );
	}
	return '';
}


/* Load font scripts */
add_action( 'wp_enqueue_scripts', 'tamatebako_fonts_enqueue_scripts' );

/**
 * Enqueue ( Google ) Fonts
 */
function tamatebako_fonts_enqueue_scripts(){
	$google_fonts_url = tamatebako_fonts_all_google_url();
	if( !empty( $google_fonts_url ) ){
		wp_enqueue_style( 'tamatebako-custom-fonts', $google_fonts_url, array(), tamatebako_theme_version(), 'all'  );
	}
}

/* Print Style to wp_head */
add_action( 'wp_head', 'tamatebako_fonts_print_style' );

/**
 * Print CSS to Modify Font
 */
function tamatebako_fonts_print_style(){

	/* CSS */
	$css = '';

	/* Config */
	$config = tamatebako_fonts_config();
	
	/* Foreach setting */
	foreach( $config as $section => $section_data ){

		/* Get font saved. */
		$font = get_theme_mod( $section, $section_data['default'] );

		/* Only add if it's not the default. */
		if( $font ){

			$target_element = $section_data['target'];
			$font_family = tamatebako_get_font_family( $font );

			$css .= "{$target_element}{font-family:{$font_family};}";

		}

	}

	/* PRINT CSS */
	if ( !empty( $css ) ){
		echo "\n" . '<style type="text/css" id="tamatebako-custom-fonts-rules-css">' . trim( $css ) . '</style>' . "\n";
	}
}

/* Add body classes */
add_filter( 'body_class', 'tamatebako_fonts_body_class' );

/**
 * Custom Font: Body Class Status
 */
function tamatebako_fonts_body_class( $classes ){

	/* Add active status */
	$classes[] = 'custom-fonts-active';

	/* Get fonts config */
	$config = tamatebako_fonts_config();

	/* Foreach setting */
	foreach( $config as $section => $section_data ){
		/* Add class */
		$classes[] = sanitize_html_class( 'tf-' . $section . '-' . get_theme_mod( $section, $section_data['default'] ) );
	}
	return array_unique( $classes );
}


/* === EDITOR STYLE === */

$settings = tamatebako_fonts_settings();
if ( isset( $settings['editor_styles'] ) && !empty( $settings['editor_styles'] ) ){
	tamatebako_include( 'modules/custom-fonts/editor-style' );
}
