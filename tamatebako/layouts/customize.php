<?php
/**
 * Layouts Customizer
 * @since 3.0.0
 */

/* Add layout option in Customize. */
add_action( 'customize_register', 'tamatebako_layouts_customize_register' );

/**
 * Registers Customizer sections, settings, and controls
 */
function tamatebako_layouts_customize_register( $wp_customize ) {

	/* Layouts Choices */
	$layouts = tamatebako_layouts();
	unset( $layouts['default'] );
	$layouts[tamatebako_layout_default()] = $layouts[tamatebako_layout_default()] . ' (' . tamatebako_string( 'Default' ) . ')';

	/* Add the layout section. */
	$wp_customize->add_section(
		'layout',
		array(
			'title'      => esc_html( tamatebako_string( 'Layout' ) ),
			'priority'   => 190,
			'capability' => 'edit_theme_options'
		)
	);

	/* Add the 'layout' setting. */
	$wp_customize->add_setting(
		'theme_layout',
		array(
			'default'           => tamatebako_layout_default(),
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_html_class',
			'transport'         => 'refresh'
		)
	);

	/* Add the layout control. */
	$wp_customize->add_control(
		'theme-layout-control',
		array(
			'label'    => esc_html( tamatebako_string( 'Global Layout' ) ),
			'section'  => 'layout',
			'settings' => 'theme_layout',
			'type'     => 'radio',
			'choices'  => $layouts,
		)
	);

}






