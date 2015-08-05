<?php
/**
 * Custom Fonts Options
 * Google fonts also enqueued using this feature.
**/

$fonts_config = array(
	'site_title_font' => array(
		'label' => _x( 'Site Title Fonts', 'customizer', 'nokonoko' ),
		'target' => '#site-title',
		'fonts' => array( 'websafe', 'heading', 'base' ),
		'default' => 'Open Sans',
	),
	'post_title_font' => array(
		'label' => _x( 'Post Title Fonts', 'customizer', 'nokonoko' ),
		'target' => '#content .entry-title',
		'fonts' => array( 'websafe', 'heading', 'base' ),
		'default' => 'Open Sans',
	),
	'base_font' => array(
		'label' => _x( 'Base Fonts', 'customizer', 'nokonoko' ),
		'target' => 'body.wordpress',
		'fonts' => array( 'websafe', 'base' ),
		'default' => 'Open Sans',
	),
);

$fonts_strings = array(
	'fonts' => _x( 'Fonts', 'customizer', 'nokonoko' ),
);

add_theme_support( 'tamatebako-custom-fonts', $fonts_config, $fonts_strings );


