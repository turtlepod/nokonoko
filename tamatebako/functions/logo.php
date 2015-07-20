<?php
/**
 * Logo
**/

/**
 * Logo Args
 */
function tamatebako_logo_args(){

	/* Get theme support */
	$logo_support = get_theme_support( 'tamatebako-logo' );
	$theme_args = array();
	if ( isset( $logo_support[0] ) ){
		$theme_args = $logo_support[0];
	}

	/* Default Args */
	$defaults_args = array( 
		'section'             => 'default-image',
		'section'             => 'title_tagline',
		'label'               => 'Logo',
		'description'         => '',
		'flex_width'          => true,
		'flex_height'         => false,
		'width'               => 300,
		'height'              => 200,
	);

	/* Logo Args. */
	return wp_parse_args( $theme_args, $defaults_args );
}


/* Register Custom CSS to Customizer */
add_action( 'customize_register', 'tamatebako_logo_customize_register' );

/**
 * Register Customizer
 * @since 3.0.0
 */
function tamatebako_logo_customize_register( $wp_customize ){

	/* Add Setting: as theme mod. */
	$wp_customize->add_setting(
		'logo',
		array(
			'type'                => 'theme_mod',
			'transport'           => 'refresh',
			'capability'          => 'edit_theme_options',
			'sanitize_callback'   => 'esc_html',
		)
	);

	/* Add Control (WP 4.3 with image cropper) */
	if ( class_exists( 'WP_Customize_Cropped_Image_Control' ) ) {
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control( $wp_customize, 'logo', tamatebako_logo_args() )
		);
	}
	/* WP 4.2, use image as is. */
	elseif( class_exists( 'WP_Customize_Media_Control' ) ){
		$wp_customize->add_control(
			new WP_Customize_Media_Control( $wp_customize, 'logo', tamatebako_logo_args() )
		);
	}
}


/* Body Class */
add_filter( 'body_class', 'tamatebako_logo_body_class' );

/**
 * Add body class for styling.
 */
function tamatebako_logo_body_class( $classes ) {
	if( current_theme_supports( 'tamatebako-logo' ) ){
		$classes[] = 'logo-active';
		if( get_theme_mod( 'logo' ) ){
			$classes[] = 'logo-uploaded';
		}
	}
	return $classes;
}


/**
 * Logo URL
 * @link https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
 */
function tamatebako_logo_url(){

	/* if theme supports it and logo uploaded, return logo URL */
	if( current_theme_supports( 'tamatebako-logo' ) && get_theme_mod( 'logo' ) ){
		$image = wp_get_attachment_image_src( absint( get_theme_mod( 'logo' ) ), 'full' );
		return $image[0]; /* image URL */
	}

	/* If default logo image defined, use it as fallback. */
	$logo_args = tamatebako_logo_args();
	if( !empty( $logo_args['default-logo'] ) ){
		return $logo_args['default-logo'];
	}
	return '';
}
