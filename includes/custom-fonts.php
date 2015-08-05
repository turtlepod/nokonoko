<?php
/**
 * Custom Fonts Options
 * Google fonts also enqueued using this feature.
**/

$fonts_config = array(
	'site_title_font' => array(
		'label' => _x( 'Site Title Font', 'customizer', 'nokonoko' ),
		'target' => '#site-title',
		'fonts' => array( 'websafe', 'heading', 'base' ),
		'default' => 'Open Sans',
	),
	'post_title_font' => array(
		'label' => _x( 'Post Title Font', 'customizer', 'nokonoko' ),
		'target' => '#content .entry-title',
		'fonts' => array( 'websafe', 'heading', 'base' ),
		'default' => 'Open Sans',
	),
	'content_h2' => array(
		'label' => _x( 'Content Heading 2', 'customizer', 'nokonoko' ),
		'target' => '.entry-summary h2,.entry-content h2,body#tinymce h2',
		'fonts' => array( 'heading' ),
		'default' => 'Cherry Swash',
	),
	'base_font' => array(
		'label' => _x( 'Base Font', 'customizer', 'nokonoko' ),
		'target' => 'body.wordpress,body#tinymce',
		'fonts' => array( 'websafe', 'base' ),
		'default' => 'Open Sans',
	),
);

$fonts_settings = array(
	'editor_styles' => array(
		'base_font',
		'content_h2',
	),
);

$fonts_strings = array(
	'fonts' => _x( 'Fonts', 'customizer', 'nokonoko' ),
);

add_theme_support( 'tamatebako-custom-fonts', $fonts_config, $fonts_settings, $fonts_strings );


