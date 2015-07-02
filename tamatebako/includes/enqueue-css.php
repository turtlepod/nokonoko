<?php
/**
 * Enqueue JS
 * @since 0.1.0
**/

/* Hook to theme setup */
add_action( 'after_setup_theme', 'tamatebako_enqueue_css_setup', 20 );


/**
 * Register Sidebar Setup.
 * @since 3.0.0
 */
function tamatebako_enqueue_css_setup(){

	/* Register Sidebars */
	add_action( 'wp_enqueue_scripts', 'tamatebako_enqueue_css' );
}


/**
 * Enqueue JS
 * @since 3.0.0
 */
function tamatebako_enqueue_css(){

	/* Get theme-supported sidebars. */
	$scripts = get_theme_support( 'tamatebako-enqueue-css' );

	/* No Support, Return */
	if ( !is_array( $scripts[0] ) ){
		return;
	}

	/* Foreach scrips, enqueue it */
	foreach( $scripts[0] as $script_handle => $script_args ){

		/* Add Sidebar ID */
		$script_args['handle'] = $script_handle;

		/* Defaults */
		$defaults_args = array(
			'handle'     => '',
			'src'        => '',
			'deps'       => array(),
			'ver'        => tamatebako_theme_version(),
			'media'      => 'all',
			'external'   => false,
		);

		/* Merge */
		$script_args = wp_parse_args( $script_args, $defaults_args );

		/* Enqueue it. */
		if( !empty( $script_args['handle'] ) && !empty( $script_args['src'] ) ){
			if( false === $script_args['external'] ){
				$script_args['src'] = tamatebako_theme_file( $script_args['src'], 'css' );
			}
			if( $script_args['src'] ){
				wp_enqueue_style( $script_args['handle'], $script_args['src'], $script_args['deps'], $script_args['ver'], $script_args['media'] );
			}
		}

	}
}


