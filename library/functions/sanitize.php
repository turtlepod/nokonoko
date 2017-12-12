<?php
/**
 * Various Sanitization, Validation, and Related Helper Functions.
 *
 * @since 3.0.0
 * @author GenbuMedia
**/

/* === CHECKBOX === */

/**
 * Checkbox Sanitization Helper Function
 *
 * @since 3.0.0
 *
 * @param mixed $input Data input.
 * @return bool Data output.
 */
function tamatebako_sanitize_checkbox( $input ) {
	if ( isset( $input ) && ! empty( $input ) ) {
		return true;
	}
	return false;
}

/* === COLOR === */

/**
 * Utillity function to converts a hex color to RGB.
 * Returns the RGB values as an array.
 *
 * Usage:
 * $color_rgb = join( ', ', tamatebako_hex_to_rgb( $color ) );
 * $css = ".element{ background: rgba({$color_rgb},0.7); }";
 *
 * @since 3.0.0
 * @author Justin Tadlock <justintadlock@gmail.com>
 *
 * @param string $hex Hex color.
 * @return array RGB color array.
 */
function tamatebako_hex_to_rgb( $hex ) {
	// Remove "#" if it was added.
	$color = trim( $hex, '#' );

	// If the color is three characters, convert it to six.
	if ( 3 === strlen( $color ) ) {
		$color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
	}

	// Get the red, green, and blue values in rgb array.
	$rgb = array(
		'r' => hexdec( $color[0] . $color[1] ),
		'g' => hexdec( $color[2] . $color[3] ),
		'b' => hexdec( $color[4] . $color[5] ),
	);

	return $rgb;
}

/**
 * Hex Color Sanitization Helper Function
 * This function added to sanitize color in front end, 
 * because wp sanitize_hex_color() only available in customize screen.
 * This is duplicate for sanitize_hex_color() wp-includes/class-wp-customize-manager.php
 *
 * @since 1.0.1
 *
 * @param string $color Hex color.
 * @return string
 */
function tamatebako_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return '';
}

/**
 * Hex Color Sanitization Helper Function
 * This function added to sanitize color in front end,
 * because wp sanitize_hex_color_no_hash() only available in customize screen.
 * This is duplicate for sanitize_hex_color_no_hash() wp-includes/class-wp-customize-manager.php
 *
 * @since 1.0.1
 *
 * @param string $color Hex color.
 * @return string
 */
function tamatebako_sanitize_hex_color_no_hash( $color ) {
	// Remove hashtag.
	$color = ltrim( $color, '#' );

	// Check using sanitize hex color.
	return $color && tamatebako_sanitize_hex_color( '#' . $color ) ? $color : null;
}

/* === FILE === */

/**
 * Sanitize File Type
 * Check if data is an certain file type.
 *
 * example in checking image file:
 * $image_url = tamatebako_sanitize_filetype( $url, 'image' );
 * will return empty if not valid.
 *
 * file type: "application", "audio", "video", "image", "text", etc.
 *
 * @since 3.0.0
 * @link https://en.wikipedia.org/wiki/Internet_media_type#List_of_common_media_types
 *
 * @param string       $input Data input.
 * @param string|array $type  File type. Use array for multiple types.
 * @return string
 */
function tamatebako_sanitize_file_type( $input, $type = 'image' ) {
	// Check file type of input.
	$filetype = wp_check_filetype( $input );
	$mime_type = $filetype['type'];

	// Single type check.
	if ( is_string( $type ) ) {

		// Only file allowed.
		if ( strpos( $mime_type, $type ) !== false ) {
			return $input;
		}
	} elseif ( is_array( $type ) ) { // Multiple file type in array.

		// Loop foreach file type allowed.
		foreach ( $type as $single_type ) {
			if ( strpos( $mime_type, $single_type ) !== false ){
				return $input;
			}
		}
	}
	return '';
}

/**
 * Sanitize File Extension
 * Check if data have correct file ext.
 * Same with tamatebako_sanitize_file_type() but for file ext.
 *
 * @param string       $input Data input.
 * @param string|array $ext   Allowed file extention.
 * @return string
 */
function tamatebako_sanitize_file_ext( $input, $ext = 'css' ) {
	// Check file type.
	$filetype = wp_check_filetype( $input );
	$file_ext = $filetype['ext'];

	// Single ext check.
	if ( is_string( $ext ) ) {

		// If file ext match, return it.
		if ( $ext === $file_ext ) {
			return $input;
		}
	} elseif ( is_array( $ext ) ) { // Multi ext check.

		// Loop foreach file ext allowed.
		foreach ( $ext as $single_ext ) {
			if ( $single_ext === $file_ext ) {
				return $input;
			}
		}
	}

	return '';
}

/**
 * Sanitize Scripts such as CSS code.
 * It will also restore several character from esc_html().
 * For output in front end it's best to simply use "wp_strip_all_tags()"
 *
 * @since 3.3.3
 *
 * @param string $css CSS code.
 * @return string
 */
function tamatebako_esc_css( $css ) {
	$css = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $css );
	$css = wp_kses( $css, array() );
	$css = esc_html( $css );
	$css = str_replace( '&gt;', '>', $css );
	$css = str_replace( '&quot;', '"', $css );
	$css = str_replace( '&amp;', "&", $css );
	$css = str_replace( '&amp;#039;', "'", $css );
	$css = str_replace( '&#039;', "'", $css );
	return $css;
}
