<?php
/**
 * Helper Functions
 * @since 3.0.0
**/

/**
 * Including a PHP file within the framework if the file exists.
 * @since  3.0.0
 * @param  string  $file   File path relative to framework.
 * @access private
 */
function tamatebako_include( $file ){

	/* Theme Dir */
	$theme_path = trailingslashit( get_template_directory() );

	/* Tamatebako Dir */
	$tamatebako_path = trailingslashit( $theme_path . TAMATEBAKO_DIR );

	/* File Path */
	$file_path = $tamatebako_path . $file . '.php';

	/* Check file exist before loading it. */
	if( file_exists( $file_path ) ) {
		include_once( $file_path );
	}
}


/**
 * Including a PHP file if a theme feature is supported and the file exists.
 * @since  3.0.0
 * @param  string  $feature   Theme support feature.
 * @param  string  $file      File path relative to framework.
 * @access private
 */
function tamatebako_require_if_theme_supports( $feature, $file ) {

	/* Theme Dir */
	$theme_path = trailingslashit( get_template_directory() );

	/* Tamatebako Dir */
	$tamatebako_path = trailingslashit( $theme_path . TAMATEBAKO_DIR );

	/* File Path */
	$file_path = $tamatebako_path . $file . '.php';

	/* Check if feature is supported and file exist before loading it. */
	if ( current_theme_supports( $feature ) && file_exists( $file_path ) ){
		require_once( $file_path );
	}
}


/**
 * Helper Function: Get (parent) theme version
 * This function is to properly add version number to scripts and styles.
 * @since 0.1.0
 */
function tamatebako_theme_version(){
	$theme = wp_get_theme( get_template() );
	return $theme->get( 'Version' );
}


/**
 * Get parent theme assets file.
 * Return empty file not exist.
 * Search for minified version of the file and load it using on SCRIPT_DEBUG constants as priority.
 * @since  3.0.0
 * @param  string  $path      File path to load relative to child theme directory.
 * @param  string  $ext       File extension, e.g "js" or "css".
 * @access public
 * @return string
 */
function tamatebako_theme_file( $path, $ext ){

	/* Debug Mode Status, if debug do not load min file. */
	$debug = false;
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ){
		$debug = true;
	}

	/* File Path & URI */
	$file_path = trailingslashit( get_template_directory() ) . $path;
	$file_uri = trailingslashit( get_template_directory_uri() ) . $path;

	/* On debug mode, load non min file, first. */
	if ( $debug ){

		/* return parent theme file if exist */
		if ( file_exists(  $file_path . '.' . $ext ) ){
			return $file_uri . '.' . $ext;
		}
		/* return parent theme min file if exist */
		elseif ( file_exists( $file_path . '.min.' . $ext ) ){
			return $file_uri . '.min.' . $ext;
		}
		/* return empty string */
		else{
			return '';
		}
	}

	/* Not debug mode, load min file if exist. */
	else{

		/* return parent theme min file if exist */
		if ( file_exists( $file_path . '.min.' . $ext ) ){
			return $file_uri . '.min.' . $ext;
		}
		/* return parent theme regular file if exist */
		elseif ( file_exists( $file_path . '.' . $ext ) ){
			return $file_uri . '.' . $ext;
		}
		/* return empty string */
		else{
			return '';
		}
	}
}


/**
 * Get child theme assets file.
 * Return empty if child theme not active or file not exist.
 * Search for minified version of the file and load it using on SCRIPT_DEBUG constants as priority.
 * @since  3.0.0
 * @param  string  $path      File path to load relative to child theme directory.
 * @param  string  $ext       File extension, e.g "js" or "css".
 * @access public
 * @return string
 */
function tamatebako_child_theme_file( $path, $ext ){

	/* Debug Mode Status, if debug do not load min file. */
	$debug = false;
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ){
		$debug = true;
	}

	/* File Path & URI */
	$file_path = trailingslashit( get_stylesheet_directory() ) . $path;
	$file_uri = trailingslashit( get_stylesheet_directory_uri() ) . $path;

	/* If Child Theme Active */
	if ( is_child_theme() ){

		/* On debug mode, load non min file, first. */
		if ( $debug ){
			/* return child theme file if exist */
			if ( file_exists( $file_path . '.' . $ext ) ){
				return $file_uri . '.' . $ext;
			}
			/* return child theme min file if exist */
			elseif ( file_exists( $file_path . '.min.' . $ext ) ){
				return $file_uri . '.min.' . $ext;
			}
			/* return empty string */
			else{
				return '';
			}
		}

		/* Not debug mode, load min file if exist. */
		else{
			/* return child theme min file if exist */
			if ( file_exists( $file_path . '.min.' . $ext ) ){
				return $file_uri . '.min.' . $ext;
			}
			/* return child theme regular file if exist */
			elseif ( file_exists( $file_path . '.' . $ext ) ){
				return $file_uri . '.' . $ext;
			}
			/* return empty string */
			else{
				return '';
			}
		}
	}
	return '';
}