<?php
/**
 * Enqueue JS
 * @since 0.1.0
**/

/* Hook to theme setup */
add_action( 'after_setup_theme', 'tamatebako_register_css_setup', 20 );


/**
 * Register CSS Setup.
 * @since 3.0.0
 */
function tamatebako_register_css_setup(){

	/* Register CSS */
	add_action( 'wp_enqueue_scripts', 'tamatebako_register_css', 1 );
}


/**
 * Register CSS
 * @since 3.0.0
 */
function tamatebako_register_css(){

	/* Get CSS */
	$scripts = get_theme_support( 'tamatebako-register-css' );

	/* No Support, Return */
	if ( !is_array( $scripts[0] ) ){
		return;
	}

	/* Foreach scrips, enqueue it */
	foreach( $scripts[0] as $script_handle => $script_args ){

		/* Add Handle */
		$script_args['handle'] = $script_handle;

		/* Defaults */
		$defaults_args = array(
			'handle'     => '',
			'src'        => '',
			'deps'       => array(),
			'ver'        => tamatebako_theme_version(),
			'media'      => 'all',
		);

		/* Merge */
		$script_args = wp_parse_args( $script_args, $defaults_args );

		/* Register it. */
		if( !empty( $script_args['handle'] ) && !empty( $script_args['src'] ) ){
			wp_register_style(
				sanitize_key( $script_args['handle'] ),
				esc_url( $script_args['src'] ),
				is_array( $script_args['deps'] ) ? $script_args['deps'] : array(),
				esc_attr( $script_args['ver'] ),
				esc_attr( $script_args['media'] )
			);
		}
	} // end foreach
}

