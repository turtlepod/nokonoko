<?php
/**
 * Full Size Background Module.
 * Easily create full size background option in customizer.
 *
 * @since 3.0.0
 * @author GenbuMedia
**/

/**
 * Full Size Background Args
 *
 * @since 3.0.0
 *
 * @return array
 */
function tamatebako_full_size_background_args() {
	$full_size_bg_support = get_theme_support( 'tamatebako-full-size-background' );
	$theme_args = array();

	if ( isset( $full_size_bg_support[0] ) ) {
		$theme_args = $full_size_bg_support[0];
	}

	$defaults_args = array( 
		'label'            => 'Full Size Background',
		'wp-head-callback' => 'tamatebako_full_size_background_wp_head',
	);

	return wp_parse_args( $theme_args, $defaults_args );
}

// Add customizer option.
add_action( 'customize_register', 'tamatebako_full_size_background_customizer_register' );

/**
 * Register Full Size Background Customizer Setting
 *
 * @since 3.0.0
 */
function tamatebako_full_size_background_customizer_register( $wp_customize ) {
	$full_size_bg_args = tamatebako_full_size_background_args();

	// Settings.
	$wp_customize->add_setting( 'full_size_background', array(
		'default'             => 0,
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'tamatebako_sanitize_checkbox',
	) );

	// Add it in background image section.
	$wp_customize->add_control( 'full_size_background', array(
		'settings'            => 'full_size_background',
		'section'             => 'background_image',
		'label'               => esc_html( $full_size_bg_args['label'] ),
		'type'                => 'checkbox',
		'priority'            => 20,
	) );
}

// Add body class.
add_action( 'body_class', 'tamatebako_full_size_background_body_class' );

/**
 * Add body class for full width background.
 *
 * @since 1.0.0
 *
 * @param array $classes Body classes.
 * @return array
 */
function tamatebako_full_size_background_body_class( $classes ) {
	if ( get_theme_mod( 'full_size_background', '' ) ) {
		$classes[] = 'full-size-background';
	}

	return $classes;
}

// WP Head Callback.
$full_size_bg_args = tamatebako_full_size_background_args();
if ( $full_size_bg_args['wp-head-callback'] ) {
	add_action( 'wp_head', $full_size_bg_args['wp-head-callback'], 20 );
}

/**
 * Default WP Head Callback
 *
 * @since 3.0.0
 */
function tamatebako_full_size_background_wp_head() {
?>
<style type="text/css" id="full-size-background-css">
body.full-size-background{
	background-size: cover;
	background-attachment: fixed;
}
</style>
<?php
}
