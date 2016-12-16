<?php
/**
 * Utility Functions
 * This functions use anon functions, require PHP 5.3 or later.
 * @since 1.2.3
 */

/**
 * Set Layout
 * @param $new_layout string
 * @since 0.1.0
 */
function tamatebako_set_layout( $new_layout ){
	$filter_layout = function( $layout ) use( $new_layout ){
		return $new_layout;
	};
	add_filter( 'theme_mod_theme_layout', $filter_layout );
}

/**
 * Set Template Dir
 * @param $old_dir string
 * @param $new_dir string
 * @since 0.1.0
 */
function tamatebako_set_template_dir( $new_dir, $old_dir = 'content' ){
	$filter_dir = function( $dir ) use( $new_dir, $old_dir ){
		if ( $dir == $old_dir ){
			return $new_dir;
		}
		return $dir;
	};
	add_filter( 'tamatebako_get_template_dir', $filter_dir );
}

/**
 * Add Body Classes
 * @param $new_classes array
 * @since 0.1.0
 */
function tamatebako_add_body_class( $new_classes ){
	$add_classes = function( $classes ) use( $new_classes ){
		foreach( $new_classes as $new_class ){
			$classes[] = $new_class;
		}
		$classes = array_unique( $classes );
		return $classes;
	};
	add_filter( 'body_class', $add_classes );
}


/**
 * Load SVG Icons
 * For both SVG inline and SVG sprite
 * @since 3.5.0
 */
function tamatebako_get_svg( $args = array() ){
	ob_start();

	/* Set args defaults */
	$defaults = array(
		'sprite'      => false,      // sprite id, false for inline e.g "esicons" / "esocons"
		'file'        => '',         // file for svg sprite
		'icon'        => 'default',  // icon id e.g esocons-star
		'class'       => 'icon',     // (full) icon classes
	);
	$args = wp_parse_args( $args, $defaults );
	$args = array_map( 'esc_html', $args );

	/* Sprite */
	if( $args['sprite'] && $args['icon'] ){
		?>
		<svg class="<?php echo esc_attr( $args['class'] ); ?>" aria-hidden="true" role="img">
			 <use href="#<?php echo esc_html( $args['icon'] ); ?>" xlink:href="#<?php echo esc_html( $args['icon'] ); ?>"></use> 
		</svg>
		<?php
		/* Load sprite in footer. */
		add_filter( 'tamatebako_svg_sprites', function( $icons ) use( $args ){
			$id         = $args['sprite'];
			$icons[$id] = $args['file'];
			return $icons;
		} );
	}

	/* Inline */
	else{
		if ( file_exists( $args['file'] ) ) {
			?>
			<span class="<?php echo esc_attr( $args['class'] ); ?>">
				<?php require_once( $args['file'] ); ?>
			</span>
			<?php
		}
	}

	return ob_get_clean();
}
