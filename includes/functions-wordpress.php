<?php
/**
 * WordPress Feature Support
 *
 * - Custom logo.
 * - Custom background.
 *
 * @since 1.0.0
 * @author GenbuMedia
 */

/* === CUSTOM LOGO === */

$logo_args = array(
	'width'        => 300,    // px
	'height'       => 100,    // px
	'flex-height'  => true,   // bool
	'flex-width'   => true,   // bool
	'header-text'  => array( 'site-title', 'site-description' ), // HTML classes.
);
add_theme_support( 'custom-logo', $logo_args );


/* === CUSTOM BACKGROUND === */

$custom_backgound_args = array(
	'default-color'     => '',
	'default-image'     => '',
	'wp-head-callback'  => '_custom_background_cb',
);
add_theme_support( 'custom-background', $custom_backgound_args );


/* === HEADER IMAGE === */

$custom_header_args = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false, // false, use as logo.
	'uploads'                => true,
	'wp-head-callback'       => '',
);
//add_theme_support( 'custom-header', $custom_header_args );




