<?php
/**
 * Customizer Custom CSS
**/
add_action( 'customize_register', 'tamatebako_custom_css_customize_register', 15 );


/**
 * Register Customizer
 */
function tamatebako_custom_css_customize_register( $wp_customize ){

	/* Add Panel: for larger area */
	$wp_customize->add_panel(
		'custom_css',
		array(
			'priority'    => 200,
			'title'       => esc_html( tamatebako_string( 'custom_css' ) ),
		)
	);

	/* Add Section */
	$wp_customize->add_section(
		'custom_css',
		array(
			'title'       => esc_html( tamatebako_string( 'custom_css' ) ),
			'panel'       => 'custom_css',
		)
	);

	/* Add Setting: as theme mod. */
	$wp_customize->add_setting(
		'custom_css',
		array(
			'type'                => 'theme_mod',
			'transport'           => 'postMessage',
			'capability'          => 'edit_theme_options',
			'sanitize_callback'   => 'tamatebako_sanitize_css',
		)
	);

	// Uses the `textarea` type added in WordPress 4.0.
	$wp_customize->add_control(
		'custom_css',
		array(
			'label'       => '',
			'type'        => 'textarea',
			'section'     => 'custom_css',
	) );
}

/* Preview Script */
add_action( 'customize_preview_init', 'tamatebako_custom_css_customizer_js' );

/**
 * JS to load changes asynchronously.
 */
function tamatebako_custom_css_customizer_js() {
	$js = trailingslashit( get_template_directory_uri() ) . TAMATEBAKO_DIR . '/scripts/custom-css.js';
	wp_enqueue_script( 'tamatebako_custom_css_preview', $js, array( 'customize-preview' ), tamatebako_theme_version(), true );
}

/* Print CSS to WP Head */
add_action( 'wp_head', 'tamatebako_custom_css_wp_head', 99 );

/**
 * Add CSS to Head.
 */
function tamatebako_custom_css_wp_head() {
	global $wp_customize;
	if( get_theme_mod( 'custom_css' ) ){
?>
<style id="custom-css" type="text/css">
<?php echo tamatebako_sanitize_css( get_theme_mod( 'custom_css' ) );?>
</style>
<?php
	}
	/* Always add empty style in customizer. */
	elseif( isset( $wp_customize ) ){
?>
<style id="custom-css" type="text/css"></style>
<?php
	}
}

/**
 * Tamatebako Sanitize CSS
 * @access Private
 */
function tamatebako_sanitize_css( $css ){
	$css = esc_html( $css );
	$css = str_replace( '&gt;', '>', $css );
	$css = str_replace( '&quot;', '"', $css );
	$css = str_replace( '&amp;', "&", $css );
	$css = str_replace( '&amp;#039;', "'", $css );
	$css = str_replace( '&#039;', "'", $css );
	return $css;
}
