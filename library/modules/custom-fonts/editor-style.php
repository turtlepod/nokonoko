<?php
/**
 * Custom Fonts: Editor Style Functions.
 * Ajax CSS in editor style is taken from "Stargazer" theme by Justin Tadlock.
 *
 * @since 3.2.0
 * @author David Chandra <david@genbumedia.com>
 * @author Justin Tadlock <justintadlock@gmail.com>
**/

/**
 * Editor Styles Setting
 *
 * @since 3.2.0
 *
 * @return array
 */
function tamatebako_fonts_mce_setting() {
	$settings = tamatebako_fonts_settings();
	return $settings['editor_styles'];
}

/**
 * Fonts used in tinymce editor.
 *
 * @since 3.2.0
 *
 * @return array
 */
function tamatebako_fonts_mce_fonts() {
	$settings = tamatebako_fonts_mce_setting();
	$config = tamatebako_fonts_config();
	$fonts = array();

	foreach ( $settings as $setting ) {
		$font = get_theme_mod( $setting, $config[ $setting ]['default'] );
		$fonts[ $font ] = tamatebako_get_font_weight( $font );
	}
	return $fonts;
}

/**
 * Get Base Font (Google Font)
 *
 * @since 3.2.0
 *
 * @return array
 */
function tamatebako_fonts_mce_google_fonts_url() {
	$google_fonts = array();
	$fonts_subsets = array();
	$fonts = tamatebako_fonts_mce_fonts();

	// Foreach fonts get data.
	foreach ( $fonts as $font_name => $font_data ) {
		$font = tamatebako_fonts_remove_websafe( $font_name );
		if ( !empty( $font ) ) {
			$google_fonts[ $font_name ] = $font_data;
			$get_font_subsets = tamatebako_get_font_subsets( $font_name );
			if ( ! empty( $get_font_subsets ) ) {
				foreach ( $get_font_subsets as $subset ) {
					$fonts_subsets[] = $subset;
				}
			}
		}
	}

	// Get available subset.
	$subsets_settings = tamatebako_fonts_subsets();
	$subsets = array_intersect( $subsets_settings, $fonts_subsets );

	return tamatebako_google_fonts_url( $google_fonts, $subsets );
}

// Add Editor Style.
add_filter( 'mce_css', 'tamatebako_fonts_mce_css' );

/**
 * WP Editor Styles
 *
 * @since 3.2.0
 *
 * @param string $mce_css Comma separated URL.
 * @return array
 */
function tamatebako_fonts_mce_css( $mce_css ) {
	$url = tamatebako_fonts_mce_google_fonts_url();

	if ( ! empty( $url ) ) {
		$mce_css .= ', ' . $url;
	}

	// Add font rules.
	$mce_css .= ', ' . add_query_arg( array(
		'action' => 'tamatebako_fonts_mce_css',
		'_nonce' => wp_create_nonce( 'tamatebako-fonts-mce-nonce', __FILE__ ),
	), admin_url( 'admin-ajax.php' ) );

	return $mce_css;
}

// AJAX Callback, editor style CSS.
add_action( 'wp_ajax_tamatebako_fonts_mce_css', 'tamatebako_fonts_mce_css_ajax_callback' );
add_action( 'wp_ajax_no_priv_tamatebako_fonts_mce_css', 'tamatebako_fonts_mce_css_ajax_callback' );

/**
 * Ajax Callback. Output CSS.
 *
 * @since 3.2.0
 */
function tamatebako_fonts_mce_css_ajax_callback() {
	if ( ! wp_verify_nonce( isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '', 'tamatebako-fonts-mce-nonce' ) ) {
		die();
	}

	$css = '';
	$settings = tamatebako_fonts_mce_setting();
	$config = tamatebako_fonts_config();

	foreach ( $settings as $setting ) {
		$target_element = $config[$setting]['target'];
		$font = get_theme_mod( $setting, $config[$setting]['default'] );
		$font_family = tamatebako_get_font_family( $font );

		$css .= "{$target_element}{font-family:{$font_family};}";
	}

	header( 'Content-type: text/css' );
	echo wp_strip_all_tags( $css );
	die();
}
