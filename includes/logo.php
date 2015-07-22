<?php
/**
 * Logo
**/

/* === Logo === */
$logo_args = array(
	//'crop'                   => true, /* set to false to disable image cropper. */
	'width'                  => 300,
	'height'                 => 200,
	'flex-height'            => true,
	'flex-width'             => true,
	'label'                  => _x( 'Logo', 'customizer', 'nokonoko' ),
	'description'            => _x( 'This will replace site title with logo in header area. Recommended size is 300px wide and 200px tall.', 'customizer', 'nokonoko' ),
);
add_theme_support( 'tamatebako-logo', $logo_args );

