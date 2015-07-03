<?php
/**
 * Helper Functions
 * @since 3.0.0
 */

/**
 * Get theme version
 * This function is to properly add version number to scripts and styles.
 * 
 * @since 0.1.0
 */
function tamatebako_theme_version(){
	$theme = wp_get_theme( get_template() );
	return $theme->get( 'Version' );
}

/**
 * Get Parent Theme Assets File.
 */
function tamatebako_theme_file( $path, $ext ){

	/* Debug Mode Status, if debug do not load min file. */
	$debug = false;
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ){
		$debug = true;
	}

	/* On debug mode, load non min file, first. */
	if ( $debug ){
		/* return parent theme file if exist */
		if ( file_exists( trailingslashit( get_template_directory() ) . $path . '.' . $ext ) ){
			return trailingslashit( get_template_directory_uri() ) . $path . '.' . $ext;
		}
		/* return parent theme min file if exist */
		elseif ( file_exists( trailingslashit( get_template_directory() ) . $path . '.min.' . $ext ) ){
			return trailingslashit( get_template_directory_uri() ) . $path . '.min.' . $ext;
		}
		/* return empty string */
		else{
			return '';
		}
	}
	/* Not debug mode, load min file if exist. */
	else{
		/* return parent theme min file if exist */
		if ( file_exists( trailingslashit( get_template_directory() ) . $path . '.min.' . $ext ) ){
			return trailingslashit( get_template_directory_uri() ) . $path . '.min.' . $ext;
		}
		/* return parent theme regular file if exist */
		elseif ( file_exists( trailingslashit( get_template_directory() ) . $path . '.' . $ext ) ){
			return trailingslashit( get_template_directory_uri() ) . $path . '.' . $ext;
		}
		/* return empty string */
		else{
			return '';
		}
	}
}

/**
 * Get Child Theme Assets File.
 */
function tamatebako_child_theme_file( $path, $ext ){

	/* Debug Mode Status, if debug do not load min file. */
	$debug = false;
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ){
		$debug = true;
	}

	/* If Child Theme Active */
	if ( is_child_theme() ){

		/* On debug mode, load non min file, first. */
		if ( $debug ){
			/* return child theme file if exist */
			if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $path . '.' . $ext ) ){
				return trailingslashit( get_stylesheet_directory_uri() ) . $path . '.' . $ext;
			}
			/* return child theme min file if exist */
			elseif ( file_exists( trailingslashit( get_stylesheet_directory() ) . $path . '.min.' . $ext ) ){
				return trailingslashit( get_stylesheet_directory_uri() ) . $path . '.min.' . $ext;
			}
			/* return empty string */
			else{
				return '';
			}
		}

		/* Not debug mode, load min file if exist. */
		else{
			/* return child theme min file if exist */
			if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $path . '.min.' . $ext ) ){
				return trailingslashit( get_stylesheet_directory_uri() ) . $path . '.min.' . $ext;
			}
			/* return child theme regular file if exist */
			elseif ( file_exists( trailingslashit( get_stylesheet_directory() ) . $path . '.' . $ext ) ){
				return trailingslashit( get_stylesheet_directory_uri() ) . $path . '.' . $ext;
			}
			/* return empty string */
			else{
				return '';
			}
		}
	}
	return '';
}

