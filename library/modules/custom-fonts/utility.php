<?php
/**
 * Custom Fonts: Utility Functions
 *
 * @since 3.2.0
 * @author GenbuMedia
**/

/**
 * Format Choices Array From Fonts Group
 *
 * @since 3.2.0
 *
 * @param array $font_groups Font groups.
 * @return array
 */
function tamatebako_fonts_format_choices( $font_groups ) {
	$output = array();

	// For each group, add it in array.
	foreach ( $font_groups as $font_group ) {

		// Add websafe font.
		if ( 'websafe' == $font_group ) {
			$fonts = tamatebako_fonts_websafe();
			foreach ( $fonts as $font_name => $font_data ) {
				$output[ $font_name ] = $font_data['name'];
			}
		} elseif ( 'heading' == $font_group ) { // Headings Fonts
			$fonts = tamatebako_fonts_heading();
			foreach ( $fonts as $font_name => $font_data ) {
				$output[ $font_name ] = $font_data['name'];
			}
		} elseif ( 'base' == $font_group ) { // Base Fonts.
			$fonts = tamatebako_fonts_base();
			foreach ( $fonts as $font_name => $font_data ) {
				$output[ $font_name ] = $font_data['name'];
			}
		}
	}

	return $output;
}

/**
 * Get Google Font Weight + Style available (as string) after compating with allowed weight/style.
 *
 * @since 3.2.0
 *
 * @param string $font_name Font name.
 * @param bool   $return_array Return as array or comma separated string.
 * @return array|string
 */
function tamatebako_get_font_weight( $font_name, $return_array = false ) {
	// Get all fonts data.
	$fonts = tamatebako_fonts();

	// Get font weight.
	if ( isset( $fonts[ $font_name ]['weight'] ) ) {

		// Allowed weight+style.
		$allowed_weight = tamatebako_fonts_allowed_weight();

		// Available weight.
		$available_weigth = $fonts[ $font_name ]['weight'];

		// Set allowed weight to "false" to load all available font.
		if ( false === $allowed_weight ) {
			$weight = $available_weigth;
		} else {
			$weight = array_intersect( $allowed_weight, $available_weigth );
		}

		if ( $return_array ) {
			return $weight;
		} else {
			return implode( ",", $weight );
		}
	}

	return '';
}

/**
 * Get Font Family (used in CSS) by Font Name
 *
 * @since 3.2.0
 *
 * @param string $font_name Font name.
 * @return string
 */
function tamatebako_get_font_family( $font_name ) {
	$fonts = tamatebako_fonts();
	if ( isset( $fonts[ $font_name ]['family'] ) ) {
		return $fonts[ $font_name ]['family'];
	}
	return 'sans-serif';
}

/**
 * Get Font Subsets
 *
 * @since 3.2.0
 *
 * @param string $font_name Font name.
 * @return string
 */
function tamatebako_get_font_subsets( $font_name ) {
	$fonts = tamatebako_fonts();
	if ( isset( $fonts[ $font_name ]['subset'] ) ) {
		return $fonts[ $font_name ]['subset'];
	}
	return '';
}

/**
 * Return empty if it's a websafe font.
 *
 * @since 3.2.0
 *
 * @param string $font Font name.
 * @return string
 */
function tamatebako_fonts_remove_websafe( $font ) {
	if ( strpos( $font, 'ws_' ) !== false ) {
		return '';
	}
	return $font;
}

/**
 * Font Weight Options
 *
 * @since 3.2.0
 *
 * @return array
 */
function tamatebako_fonts_font_weight_choices() {
	$choices = array(
		'lighter' => 'lighter',
		'normal'  => 'normal',
		'bold'    => 'bold',
		'bolder'  => 'bolder',
	);
	return apply_filters( 'tamatebako_fonts_font_weight_choices', $choices );
}
