<?php
/**
 * Layouts Customizer
 * @since 3.0.0
 */

/* Add layout option in Customize. */
add_action( 'customize_register', 'tamatebako_layouts_customizer_register' );

/**
 * Registers Customizer sections, settings, and controls
 */
function tamatebako_layouts_customizer_register( $wp_customize ) {

	/* Load Layout Customizer Class */
	tamatebako_include( 'customizer/radio-image', true );

	/* Add the layout section. */
	$wp_customize->add_section(
		'layout',
		array(
			'title' => esc_html( tamatebako_layouts_string( 'layout' ) ),
		)
	);

	/* Add the layout setting. */
	$wp_customize->add_setting(
		'theme_layout',
		array(
			'default'           => tamatebako_layout_default(),
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'refresh'
		)
	);

	/* Layout Options */
	$layouts = tamatebako_layouts();
	$choices = array();
	foreach( $layouts as $layout => $layout_data ){
		$choices[$layout] = array(
			'label' => $layout_data['name'],
			'image' => $layout_data['thumbnail'],
			'width' => '60px',
		);
	}

	/* Add the layout control. */
	$wp_customize->add_control(
		new Tamatebako_Customize_Radio_Image(
			$wp_customize,
			'theme_layout',
			array(
				'label'       => esc_html( tamatebako_layouts_string( 'global_layout' ) ),
				'section'     => 'layout',
				'settings'    => 'theme_layout',
				'choices'     => $choices,
			)
		)
	);
}


