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
	tamatebako_include( 'layouts/customizer-control' );

	/* Add the layout section. */
	$wp_customize->add_section(
		'layout',
		array(
			'title'      => esc_html( tamatebako_string( 'layout' ) ),
			'priority'   => 190,
			'capability' => 'edit_theme_options'
		)
	);

	// Add the layout setting.
	$wp_customize->add_setting(
		'theme_layout',
		array(
			'default'           => 'content',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'refresh'
		)
	);

	// Add the layout control.
	$wp_customize->add_control(
		new Tamatebako_Customize_Layout(
			$wp_customize,
			'theme_layout',
			array(
				'label'    => esc_html( tamatebako_string( 'global_layout' ) ),
				'settings' => 'theme_layout',
			)
		)
	);
}

/* Print Script and Style */
add_action( 'customize_controls_print_footer_scripts', 'tamatebako_customize_layouts_script' );
add_action( 'customize_controls_print_styles', 'tamatebako_customize_layouts_style' );

function tamatebako_customize_layouts_script(){
?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
	$( ".theme-layout-input" ).change( function(){
		if( $( this ).is(':checked') ){
			$( this ).parent( '.theme-layout-label' ).siblings( '.theme-layout-label' ).removeClass( 'layout-selected' );
			$( this ).parent( '.theme-layout-label' ).addClass( 'layout-selected' );
		}
	});
});
</script>
<?php
}

function tamatebako_customize_layouts_style(){
?>
<style id="tamatebako-customize-layouts">
.theme-layouts-thumbnail-wrap .theme-layout-input{
	display: none;
}
.theme-layouts-thumbnail-wrap .layout-name{
	display: none;
}
.theme-layouts-thumbnail-wrap .customize-control-title{
	margin-bottom: 10px;
}
.theme-layouts-thumbnail-wrap .theme-layout-label{
	width: 60px;
	display: block;
	float: left;
	margin: 0 20px 0 0;
	padding: 0;
}
.layout-thumbnail{
	width: 100%;
	height: auto;
	border: 5px solid #ccc;
}
.layout-default .layout-thumbnail{
}
.layout-selected .layout-thumbnail{
	border: 5px solid #298cba;
}
.theme-layout-label:hover .layout-thumbnail{
	opacity: 0.8;
}
</style>
<?php
}
