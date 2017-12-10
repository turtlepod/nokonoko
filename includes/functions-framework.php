<?php
/**
 * Tamatebako Framework Integration
 *
 * - Translations.
 * - Custom Fonts.
 * - Hide Page Titles.
 * - Theme Layouts.
 * - Full size background.
 *
 * @since 1.0.0
 * @author GenbuMedia
 */

/* === TRANSLATIONS === */

// Load text domain.
load_theme_textdomain( 'nokonoko', get_template_directory() . '/assets/languages' );

// Make all string in the framework translatable.
$texts = array(

	// functions/template/accessibility.php.
	'skip_to_content'             => _x( 'Skip to content', 'accessibility', 'nokonoko' ),

	// functions/template/general.php.
	'next_posts'                  => _x( 'Next', 'pagination', 'nokonoko' ),
	'previous_posts'              => _x( 'Previous', 'pagination', 'nokonoko' ),

	// functions/template/menu.php.
	'menu_search_placeholder'     => _x( 'Search&hellip;', 'nav menu', 'nokonoko' ),
	'menu_search_button'          => _x( 'Search', 'nav menu', 'nokonoko' ),
	'menu_search_form_toggle'     => _x( 'Expand Search Form', 'nav menu', 'nokonoko' ),
	'menu_default_home'           => _x( 'Home', 'nav menu', 'nokonoko' ),

	// functions/template/entry.php.
	'error_title'                 => _x( '404 Not Found', 'entry', 'nokonoko' ),
	'error_message'               => _x( 'Apologies, but no entries were found.', 'entry', 'nokonoko' ),
	'next_post'                   => _x( 'Next', 'entry', 'nokonoko' ),
	'previous_post'               => _x( 'Previous', 'entry', 'nokonoko' ),

	// functions/template/comment.php.
	'next_comment'                => _x( 'Next', 'comment', 'nokonoko' ),
	'previous_comment'            => _x( 'Previous', 'comment', 'nokonoko' ),
	'comments_closed_pings_open'  => _x( 'Comments are closed, but trackbacks and pingbacks are open.', 'comment', 'nokonoko' ),
	'comments_closed'             => _x( 'Comments are closed.', 'comment', 'nokonoko' ),
	'comment_parent_link_text'    => _x( 'In reply to %s', 'comment', 'nokonoko' ),

	// functions/setup.php.
	'untitled'                    => _x( '(Untitled)', 'entry', 'nokonoko' ),
	'read_more'                   => _x( 'Read More', 'entry', 'nokonoko' ),
	'search_title_prefix'         => _x( 'Search:', 'archive title', 'nokonoko' ),
	'comment_moderation_message'  => _x( 'Your comment is awaiting moderation.', 'comment', 'nokonoko' ),

);

// Add text to tamatebako.
tamatebako_load_strings( $texts );


/* === CUSTOM FONTS === */

// Customizer setting configuration.
$fonts_config = array(
	'font_site_title' => array(
		'label'       => _x( 'Site Title Font', 'customizer', 'nokonoko' ),
		'description' => _x( 'You can select your preferred font for your site title below.', 'customizer', 'nokonoko' ),
		'target'      => '#site-title',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Open Sans',
	),
	'font_post_title' => array(
		'label'       => _x( 'Post Title Font', 'customizer', 'nokonoko' ),
		'target'      => '#content .entry-title',
		'fonts'       => array( 'websafe', 'heading', 'base' ),
		'default'     => 'Open Sans',
	),
	'font_content_h2' => array(
		'label'       => _x( 'Content Heading 2', 'customizer', 'nokonoko' ),
		'target'      => '.entry-summary h2,.entry-content h2,body#tinymce h2',
		'fonts'       => array( 'heading' ),
		'default'     => 'Cherry Swash',
	),
	'font_base'       => array(
		'label'       => _x( 'Base Font', 'customizer', 'nokonoko' ),
		'target'      => 'body.wordpress,body#tinymce',
		'fonts'       => array( 'websafe', 'base' ),
		'default'     => 'Open Sans',
	),
);

// Additional settings for custom font features.
$fonts_settings = array(
	'editor_styles' => array(
		'font_base',
		'font_content_h2',
	),
	/**
	 * Translators: to add an additional font character subset specific to your language
	 * translate this to 'greek', 'cyrillic', or 'vietnamese'. Do not translate into your own language.
	 * Note: availability of the subset depends on fonts selected.
	 */
	'font_subset' => _x( 'no-subset', 'Google Font Subset: add new subset( greek, cyrillic, vietnamese )', 'nokonoko' ),
	'allowed_weight' => array( '300', '300italic', '400', '400italic', '700', '700italic' ),
);

// Additional strings used in custom font feature.
$fonts_strings = array(
	'fonts' => _x( 'Fonts', 'customizer', 'nokonoko' ),
);

// Add support to custom fonts.
add_theme_support( 'tamatebako-custom-fonts', $fonts_config, $fonts_settings, $fonts_strings );


/* === HIDE PAGE TITLES === */

// Hide Page Title Option.
add_theme_support( 'tamatebako-hide-page-title', array( 'label' => _x( 'Hide title in single page?', 'hide page title', 'nokonoko' ) ) );


/* === THEME LAYOUTS === */

// Layout Setup.
$image_dir = get_template_directory_uri() . '/assets/images/layouts/';
$layouts = array(
	// One columns.
	'content' => array(
		'name'          => _x( 'Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content.png',
	),
	// Two columns.
	'content-sidebar1'  => array(
		'name'          => _x( 'Content | Sidebar 1', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'content-sidebar1.png',
	),
	'sidebar1-content'  => array(
		'name'          => _x( 'Sidebar 1 | Content', 'layout name', 'nokonoko' ),
		'thumbnail'     => $image_dir . 'sidebar1-content.png',
	),
);
$layouts_args = array(
	'default'           => 'content-sidebar1',
	'customize'         => true,
	'post_meta'         => true,
	'post_types'        => array( 'post' ),
	'thumbnail'         => true,
);
$layouts_strings = array(
	'default'           => _x( 'Default', 'layout', 'nokonoko' ),
	'layout'            => _x( 'Layout', 'layout', 'nokonoko' ),
	'global_layout'     => _x( 'Global Layout', 'layout', 'nokonoko' ),
);

// Add support for custom layouts.
add_theme_support( 'tamatebako-layouts', $layouts, $layouts_args, $layouts_strings );


/* === FULL SIZE BACKGROUND === */

// Full size background.
$full_size_bg_args = array(
	'label' => _x( 'Full Size Background', 'customizer', 'nokonoko' ),
);
add_theme_support( 'tamatebako-full-size-background', $full_size_bg_args );









