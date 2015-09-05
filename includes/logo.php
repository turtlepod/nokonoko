<?php
/**
 * Logo
**/

/* === Logo === */
$logo_args = array(
	'crop'                   => true, /* set to false to disable image cropper. */
	'width'                  => 300,
	'height'                 => 200,
	'flex_height'            => 1, /* 1 = true, 0 = false */
	'flex_width'             => 1, /* 1 = true, 0 = false */
	'label'                  => _x( 'Logo', 'customizer', 'nokonoko' ),
	'description'            => _x( 'This will replace site title with logo in header area. Recommended size is 300px wide and 200px tall.', 'customizer', 'nokonoko' ),
);
add_theme_support( 'tamatebako-logo', $logo_args );

