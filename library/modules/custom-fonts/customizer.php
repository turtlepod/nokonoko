<?php
/**
 * Custom Fonts Customizer
 *
 * @since 3.2.0
 * @author GenbuMedia
 */

// Add fonts options.
add_action( 'customize_register', 'tamatebako_fonts_customizer_register' );

/**
 * Registers Customizer sections, settings, and controls.
 *
 * @since 3.2.0
 *
 * @param object $wp_customize Customizer opbject.
 */
function tamatebako_fonts_customizer_register( $wp_customize ) {
	// Load custom control.
	tamatebako_include( 'modules/custom-fonts/customizer-control', true );

	// Load All Google Fonts in Customizer.
	add_action( 'customize_controls_print_styles', 'tametebako_fonts_customize_styles' );

	$config = tamatebako_fonts_config();
	$labels = tamatebako_fonts_label();

	// Panel.
	$wp_customize->add_panel( 'fonts', array(
		'title' => esc_html( $labels['fonts'] ),
	) );

	// Create Sections From Config.
	foreach ( $config as $section => $section_data ) {
		// Section.
		$wp_customize->add_section( $section, array(
			'title' => esc_html( $section_data['label'] ),
			'description' => isset( $section_data['description'] ) ? $section_data['description'] : '',
			'panel' => 'fonts',
		) );

		// Setting
		$wp_customize->add_setting( $section, array(
			'default'             => $section_data['default'],
			'type'                => 'theme_mod',
			'capability'          => 'edit_theme_options',
			'sanitize_callback'   => 'tamatebako_fonts_sanitize',
		) );

		// Control.
		$wp_customize->add_control(
			new Tamatebako_Custom_Fonts_Customize(
				$wp_customize,
				$section,
				array(
					'section'        => $section,
					'settings'       => $section,
					'choices'        => tamatebako_fonts_format_choices( $section_data['fonts'] ),
				)
			)
		);

		// Font weight.
		if ( isset( $section_data['font_weight'] ) && $section_data['font_weight'] ) {

			$section_weight = $section . '_weight';

			// Setting.
			$wp_customize->add_setting( $section_weight, array(
				'default'             => esc_attr( $section_data['font_weight'] ),
				'type'                => 'theme_mod',
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => 'tamatebako_fonts_font_weight_sanitize',
			));

			// Control.
			$wp_customize->add_control( $section_weight, array(
				'label'    => esc_html( $labels['font_weight'] ),
				'section'  => $section,
				'settings' => $section_weight,
				'type'     => 'select',
				'choices'  => tamatebako_fonts_font_weight_choices(),
			) );
		}
	} // End foreach.
}

/**
 * Enqueue Google Font In Customizer.
 *
 * @since 3.2.0
 */
function tametebako_fonts_customize_styles() {
	$google_fonts = array();

	// Get all google fonts.
	$fonts = tamatebako_fonts_google();

	foreach ( $fonts as $fonts_name => $fonts_data ) {
		$google_fonts[$fonts_name] = ''; // Do not add weight/style. just need normal font.
	}

	wp_enqueue_style( 'tamatebako-fonts-customizer', tamatebako_google_fonts_url( $google_fonts ) );
}

/**
 * Sanitize Fonts
 *
 * @since 3.2.0
 *
 * @param string $input Data input.
 * @return string
 */
function tamatebako_fonts_sanitize( $input ) {
	// Get list of all supported fonts.
	$fonts = tamatebako_fonts();

	// Check if it's in the list before saving.
	if ( array_key_exists( $input, $fonts ) ) {
		return $input;
	}

	return ''; // Empty if not valid.
}


/**
 * Sanitize Font Weight Option
 *
 * @since 3.2.0
 *
 * @param string $input Data input.
 * @return string
 */
function tamatebako_fonts_font_weight_sanitize( $input ) {
	$weights = tamatebako_fonts_font_weight_choices();

	if ( array_key_exists( $input, $weights ) ) {
		return $input;
	}

	return 'normal';
}
