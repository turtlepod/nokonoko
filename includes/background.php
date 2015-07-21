<?php
/**
 * Custom Background
**/

/* === Custom Background === */
$custom_backgound_args = array(
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
);
add_theme_support( 'custom-background', $custom_backgound_args );

/* Full Size Background (Cover) */
$full_size_bg_args = array(
	'label'                  => _x( 'Full Size Background', 'customizer', 'nokonoko' ),
);
add_theme_support( 'tamatebako-full-size-background', $full_size_bg_args );

