<?php
/**
 * Custom Fonts: Editor Style Functions.
 * Ajax CSS in editor style is taken from "Stargazer" theme by Justin Tadlock.
 * @author David Chandra <david@genbu.me>
 * @author Justin Tadlock <justintadlock@gmail.com>
**/

/**
 * Editor Styles Setting
 */
function tamatebako_fonts_mce_setting(){
	$settings = tamatebako_fonts_settings();
	return $settings['editor_styles'];
}

/**
 * Fonts used in tinymce editor.
 */
function tamatebako_fonts_mce_fonts(){

	/* Var */
	$settings = tamatebako_fonts_mce_setting();
	$config = tamatebako_fonts_config();
	$fonts = array();

	foreach( $settings as $setting ){
		$font = get_theme_mod( $setting, $config[$setting]['default'] );
		$weight = apply_filters( 'tamatebako_font_weight_mce-' . sanitize_title( $font ), '400,400italic,700,700italic' );
		$fonts[$font] = apply_filters( 'tamatebako_fonts_weight_mce', $weight );
	}
	return $fonts;
}

/**
 * Get Base Font (Google Font)
 */
function tamatebako_fonts_mce_google_fonts(){

	/* var */
	$fonts = tamatebako_fonts_mce_fonts();
	$google_fonts = array();
	foreach( $fonts as $font_name => $font_data ){
		$font = tamatebako_fonts_remove_websafe( $font_name );
		if( !empty( $font ) ){
			$google_fonts[$font_name] = $font_data;
		}
	}
	return $google_fonts;
}

/* Editor Body Class */
add_filter( 'tiny_mce_before_init', 'tamatebako_fonts_mce_body_class' );

/**
 * WP Editor Body Class
 */
function tamatebako_fonts_mce_body_class( $settings ){
	$classes = array( 'custom-fonts-active' );
	$settings['body_class'] = join( ' ', $classes );
	return $settings;
}


/* Add Editor Style */
add_filter( 'mce_css', 'tamatebako_fonts_mce_css' );

/**
 * WP Editor Styles
 */
function tamatebako_fonts_mce_css( $mce_css ){
	$url = tamatebako_google_fonts_url( tamatebako_fonts_mce_google_fonts() );
	if( !empty( $url ) ){
		$mce_css .= ', ' . $url;
	}
	$mce_css .= ', ' . add_query_arg( 'action', 'tamatebako_fonts_mce_css', admin_url( 'admin-ajax.php' ) );
	return $mce_css;
}


/* Ajax: print editor style */
add_action( 'wp_ajax_tamatebako_fonts_mce_css', 'tamatebako_fonts_mce_css_ajax_callback' );
add_action( 'wp_ajax_no_priv_tamatebako_fonts_mce_css', 'tamatebako_fonts_mce_css_ajax_callback' );

/**
 * Ajax Callback
 */
function tamatebako_fonts_mce_css_ajax_callback(){

	/* Var */
	$css = '';
	$settings = tamatebako_fonts_mce_setting();
	$config = tamatebako_fonts_config();

	foreach( $settings as $setting ){
		$font = get_theme_mod( $setting, $config[$setting]['default'] );

		$target_element = $config[$setting]['target'];
		$font_family = tamatebako_get_font_family( $font );

		$css .= "{$target_element}{font-family:{$font_family};}";
	}

	header( 'Content-type: text/css' );
	echo $css;
	die();
}

