<?php
/**
 * Helper Functions
 * @since 3.0.0
**/

/**
 * Including a PHP file within the framework if the file exists.
 * @since  3.0.0
 * @param  string  $file   File path.
 * @param  bool    $root   if true, use theme root.
 * @access public
 */
function tamatebako_include( $file, $dir = false ){

	/* Theme Path */
	$theme_path = trailingslashit( get_template_directory() );

	/* File Path */
	$file_path = $theme_path . $file . '.php';

	/* If directory not set, use tamatebako dir */
	if( false === $dir ){
		$dir = TAMATEBAKO_DIR;
	}

	/* if dir not empty, use it. */
	if( !empty( $dir ) ){
		$file_path = trailingslashit( $theme_path . $dir ) . $file . '.php';
	}

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
 * Helper Function: Get (child) theme version
 * This function is to properly add version number to scripts and styles.
 * @since 0.1.0
 */
function tamatebako_child_theme_version(){
	if( is_child_theme() ){
		$theme = wp_get_theme( get_stylesheet() );
		return $theme->get( 'Version' );
	}
	return tamatebako_theme_version();
}

/**
 * Returns the parent theme stylesheet URI.  Will return the active theme's stylesheet URI if no child
 * theme is active. Be sure to check `is_child_theme()` when using.
 */
function tamatebako_get_parent_stylesheet_uri() {
	return apply_filters( 'tamatebako_get_parent_stylesheet_uri', tamatebako_theme_file( 'assets/css/style', 'css' ) );
}


/**
 * Maybe Enqueue Style
 * Enqueue Style if the style is registered.
 */
function tamatebako_maybe_enqueue_style( $handle ){
	if( wp_style_is( sanitize_key( $handle ), 'registered' ) ){
		wp_enqueue_style( sanitize_key( $handle ) );
	}
}


/**
 * Maybe Enqueue Script
 * Enqueue Script if the script is registered.
 */
function tamatebako_maybe_enqueue_script( $handle ){
	if( wp_script_is( sanitize_key( $handle ), 'registered' ) ){
		wp_enqueue_script( sanitize_key( $handle ) );
	}
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
function tamatebako_theme_file( $file, $ext ){

	/* Debug mode. */
	$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? true : false;

	/* Path & URI */
	$path = trailingslashit( get_template_directory() ) . $file;
	$uri = trailingslashit( get_template_directory_uri() ) . $file;

	/* File URI */
	$file_uri = '';
	if( file_exists(  $path . '.' . $ext ) ){
		$file_uri = $uri . '.' . $ext;
	}

	/* Not debug & min file exist, load it! */
	if( ! $debug && file_exists(  $path . '.min.' . $ext ) ){
		$file_uri = $uri . '.min.' . $ext;
	}

	return $file_uri;
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
function tamatebako_child_theme_file( $file, $ext ){

	/* Debug mode. */
	$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? true : false;

	/* Path & URI */
	$path = trailingslashit( get_stylesheet_directory() ) . $file;
	$uri = trailingslashit( get_stylesheet_directory_uri() ) . $file;

	/* File URI */
	$file_uri = '';
	if( file_exists(  $path . '.' . $ext ) ){
		$file_uri = $uri . '.' . $ext;
	}

	/* Not debug & min file exist, load it! */
	if( ! $debug && file_exists(  $path . '.min.' . $ext ) ){
		$file_uri = $uri . '.min.' . $ext;
	}

	return $file_uri;
}

/**
 * Check Minimum System Requirement.
 * @return bool
 * @since 3.0.0
 */
function tamatebako_minimum_requirement( $data = array() ){

	global $wp_version;

	/* if system have min req, return true */
	if ( version_compare( $wp_version, $data['wp_requires'], '>=' ) && version_compare( PHP_VERSION, $data['php_requires'], '>=' ) ) {
		return true;
	}

	/* if not return false */
	return false;
}






