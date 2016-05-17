<?php
/**
 * Logo
**/
$logo_args = array(
	'width'        => 300,    // px
	'height'       => 100,    // px
	'flex-height'  => true,   // bool
	'flex-width'   => true,   // bool
	'header-text'  => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-logo', $logo_args );

