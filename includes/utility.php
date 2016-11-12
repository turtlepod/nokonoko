<?php
/**
 * Utility Features
**/
global $wp_version;
 
/* WP 4.7 Custom CSS Compat
 * Only if previously this theme have Custom CSS Module Activated.
------------------------------------------ */
if( version_compare( $wp_version, '4.7', '<' ) ){

	/* Check if user already use custom css */
	$css_id = get_theme_mod( 'custom_css_post_id' );
	$old_css = get_theme_mod( 'custom_css' ); // tamatebako custom css data

	/* User already use wp 4.7 custom css, clean old data. */
	if( $css_id && $css_id !== -1 ){
		remove_theme_mod( 'custom_css' );
	}

	/* User not yet use custom css */
	else{
		add_filter( 'wp_get_custom_css', function( $css ) use( $old_css ){
			return $old_css;
		} );
	}

}

/* Using WP 4.6 or less */
else{

	/* === CUSTOM CSS === */
	$custom_css_args = array(
		'title' => _x( 'Custom CSS', 'customizer', 'nokonoko' ),
		'label' => _x( 'Custom CSS', 'customizer', 'nokonoko' ),
	);
	add_theme_support( 'tamatebako-custom-css', $custom_css_args );
}