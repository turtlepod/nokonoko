<?php
/**
 * Full Size Background
**/

/* Add customizer option */
add_action( 'customize_register', 'tamatebako_full_size_background_customizer_register' );

/**
 * Register Customizer Setting
 */
function tamatebako_full_size_background_customizer_register( $wp_customize ){

	/* Full size bg setting */
	$wp_customize->add_setting( 'full_size_background', array(
    	'default'             => 0,
		'type'                => 'theme_mod',
		'capability'          => 'edit_theme_options',
		'sanitize_callback'   => 'tamatebako_sanitize_checkbox',
    ));

	/* add it in background image section */
    $wp_customize->add_control( 'full_size_background', array(
    	'settings'            => 'full_size_background',
		'section'             => 'background_image',
		'label'               => esc_html( tamatebako_string( 'full_size_bg' ) ),
		'type'                => 'checkbox',
		'priority'            => 20,
	));

}

/* Body Class */
add_action( 'body_class', 'tamatebako_full_size_background_body_class' );

/**
 * Add body class for full width background
 * CSS implementation included in reset.css
 */
function tamatebako_full_size_background_body_class( $classes ){

	/* full size background */
	if ( tamatebako_sanitize_checkbox( get_theme_mod( 'full_size_background', '' ) ) ){
		$classes[] = 'full-size-background';
	}

	return $classes;
}
