<?php
/**
 * Utility Features
**/

/* === MOBILE VIEW === */
add_theme_support( 'tamatebako-customize-mobile-view' );

/* === CUSTOM CSS === */
$custom_css_args = array(
	'title' => _x( 'Custom CSS', 'customizer', 'nokonoko' ),
	'label' => _x( 'Custom CSS', 'customizer', 'nokonoko' ),
);
add_theme_support( 'tamatebako-custom-css', $custom_css_args );
