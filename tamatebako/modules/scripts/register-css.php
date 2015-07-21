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

	/* Stylesheet URI */
	add_filter( 'stylesheet_uri', 'tamatebako_stylesheet_uri', 5 );

	/* Register CSS */
	add_action( 'wp_enqueue_scripts', 'tamatebako_register_css', 1 );
}


/**
 * Current Active Theme Stylesheet URI
 */
function tamatebako_stylesheet_uri( $stylesheet_uri ){

	/* Child Theme Not Active */
	if( ! is_child_theme() ){
		$stylesheet_uri = tamatebako_theme_file( 'assets/css/style', 'css' );
	}
	return $stylesheet_uri;
}


/**
 * Enqueue JS
 * @since 3.0.0
 */
function tamatebako_register_css(){

	/* == Register CSS == */

	/* Main active theme stylesheet */
	wp_register_style(
		'style',
		esc_url( get_stylesheet_uri() ),
		array(),
		is_child_theme() ? tamatebako_child_theme_version() : tamatebako_theme_version(),
		'all'
	);

	/* Parent theme if child theme active */
	if( is_child_theme() ){
		wp_register_style(
			'parent',
			esc_url( tamatebako_theme_file( 'assets/css/style', 'css' ) ),
			array(),
			tamatebako_theme_version(),
			'all'
		);
	}

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

		/* Main Theme Stylesheet */
		if( 'style' == $script_args['handle'] ){
			if( is_child_theme() ){
				$script_args['src'] = tamatebako_theme_file( 'assets/css/style', 'css' );
			}
			else{
				$script_args['src'] = get_stylesheet_uri();
			}
		}

		/* Enqueue it. */
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

