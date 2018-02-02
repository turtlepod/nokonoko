<?php
/**
 * Utility Functions
 * This functions use anon functions, require PHP 5.3 or later.
 *
 * @since 1.2.3
 * @author GenbuMedia
 */

/**
 * Set Layout.
 *
 * @since 0.1.0
 *
 * @param string $new_layout New layout to set.
 */
function tamatebako_set_layout( $new_layout ) {
	$filter_layout = function( $layout ) use( $new_layout ) {
		return $new_layout;
	};

	add_filter( 'theme_mod_theme_layout', $filter_layout );
}

/**
 * Set Template Dir,
 *
 * @since 0.1.0
 *
 * @param string $old_dir Old Dir.
 * @param string $new_dir New Dir.
 */
function tamatebako_set_template_dir( $new_dir, $old_dir = 'content' ) {
	$filter_dir = function( $dir ) use( $new_dir, $old_dir ) {
		if ( $dir == $old_dir ) {
			return $new_dir;
		}

		return $dir;
	};

	add_filter( 'tamatebako_get_template_dir', $filter_dir );
}

/**
 * Add Body Classes.
 *
 * @since 0.1.0
 *
 * @param array $new_classes Body classes.
 */
function tamatebako_add_body_class( $new_classes ) {
	$add_classes = function( $classes ) use( $new_classes ) {
		foreach ( $new_classes as $new_class ) {
			$classes[] = $new_class;
		}
		return array_unique( $classes );
	};

	add_filter( 'body_class', $add_classes );
}

/**
 * Load SVG Icons.
 *
 * For both SVG inline and SVG sprite.
 *
 * @since 3.5.0
 *
 * @param array $args SVG Args.
 */
function tamatebako_get_svg( $args = array() ) {
	$defaults = array(
		'sprite'      => false,      // Sprite id, false for inline e.g "esicons" / "esocons".
		'file'        => '',         // File for svg sprite.
		'icon'        => 'default',  // Icon id e.g esocons-star.
		'class'       => 'icon',     // (Full) icon classes.
	);
	$args = wp_parse_args( $args, $defaults );
	$args = array_map( 'esc_html', $args );

	ob_start();

	// Sprite.
	if( $args['sprite'] && $args['icon'] ) {
		?>
		<svg class="<?php echo esc_attr( $args['class'] ); ?>" aria-hidden="true" role="img">
			 <use href="#<?php echo esc_html( $args['icon'] ); ?>" xlink:href="#<?php echo esc_html( $args['icon'] ); ?>"></use> 
		</svg>
		<?php
		// Load sprite in footer.
		add_filter( 'tamatebako_svg_sprites', function( $icons ) use( $args ) {
			$id = $args['sprite'];
			$icons[ $id ] = $args['file'];
			return $icons;
		} );
	} else { // Inline.
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
