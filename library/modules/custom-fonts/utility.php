<?php
/**
 * Custom Fonts: Utility Functions
**/

/**
 * Format Choices Array From Fonts Group
 */
function tamatebako_fonts_format_choices( $font_groups ){

	/* Output */
	$output = array();

	/* For each group, add it in array. */
	foreach( $font_groups as $font_group ){

		/* Add websafe font */
		if( 'websafe' == $font_group ){
			$fonts = tamatebako_fonts_websafe();
			foreach( $fonts as $font_name => $font_data ){
				$output[$font_name] = $font_data['name'];
			}
		}

		/* Headings Fonts */
		elseif( 'heading' == $font_group ){
			$fonts = tamatebako_fonts_heading();
			foreach( $fonts as $font_name => $font_data ){
				$output[$font_name] = $font_data['name'];
			}
		}

		/* Base Fonts */
		elseif( 'base' == $font_group ){
			$fonts = tamatebako_fonts_base();
			foreach( $fonts as $font_name => $font_data ){
				$output[$font_name] = $font_data['name'];
			}
		}
	}
	return $output;
}

/**
 * Get Google Font Weight + Style available.
 */
function tamatebako_get_font_weight( $font_name ){
	$fonts = tamatebako_fonts();
	if( isset( $fonts[$font_name]['weight'] ) ){
		return $fonts[$font_name]['weight'];
	}
	return '';
}

/**
 * Get Font Family (used in CSS) by Font Name
 */
function tamatebako_get_font_family( $font_name ){
	$fonts = tamatebako_fonts();
	if( isset( $fonts[$font_name]['family'] ) ){
		return $fonts[$font_name]['family'];
	}
	return 'sans-serif';
}


/**
 * Return empty if it's a websafe font.
 */
function tamatebako_fonts_remove_websafe( $font ){
	if ( strpos( $font, 'ws_' ) !== false ) {
		return '';
	}
	return $font;
}

