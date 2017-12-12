<?php
/**
 * Helper functions
 *
 * @since 3.0.0
 * @author GenbuMedia
**/

/**
 * Including a PHP file within the framework if the file exists.
 * 
 * @since  3.0.0
 *
 * @param  string  $file      File path.
 * @param  bool    $internal  If false: use theme root. true, use intenally within the framework. 
 * @access public
 */
function tamatebako_include( $file, $internal = false ) {
	global $tamatebako;

	$theme_path = trailingslashit( get_template_directory() );
	$file_path = $theme_path . $file . '.php';

	// If internal true, use tamatebako dir.
	if ( true === $internal ) {
		$file_path = trailingslashit( $theme_path . $tamatebako->dir ) . $file . '.php';
	}

	/* Check file exist before loading it. */
	if ( file_exists( $file_path ) ) {
		include_once( $file_path );
	}
}

/**
 * Including a PHP file if a theme feature is supported and the file exists.
 *
 * @since  3.0.0
 *
 * @param  string  $feature   Theme support feature.
 * @param  string  $file      File path relative to framework.
 * @access private
 */
function tamatebako_require_if_theme_supports( $feature, $file ) {
	global $tamatebako;

	$theme_path = trailingslashit( get_template_directory() );
	$tamatebako_path = trailingslashit( $theme_path . $tamatebako->dir );
	$file_path = $tamatebako_path . $file . '.php';

	// Check if feature is supported and file exist before loading it.
	if ( current_theme_supports( $feature ) && file_exists( $file_path ) ) {
		require_once( $file_path );
	}
}

/**
 * Helper Function: Get (parent) theme version
 * This function is to properly add version number to scripts and styles.
 *
 * @since 0.1.0
 *
 * @return string
 */
function tamatebako_theme_version() {
	$theme = wp_get_theme( get_template() );
	return $theme->get( 'Version' );
}

/**
 * Helper Function: Get (child) theme version
 * This function is to properly add version number to scripts and styles.
 *
 * @since 0.1.0
 *
 * @return string
 */
function tamatebako_child_theme_version() {
	if ( is_child_theme() ) {
		$theme = wp_get_theme( get_stylesheet() );
		return $theme->get( 'Version' );
	}
	return tamatebako_theme_version();
}

/**
 * Returns the (parent) theme stylesheet URI.
 * Will return the active theme's stylesheet URI if no child
 * theme is active. Be sure to check `is_child_theme()` when using.
 *
 * @since 3.1.0
 *
 * @return string
 */
function tamatebako_get_parent_stylesheet_uri() {
	$css = tamatebako_theme_file( 'assets/theme/theme.min', 'css' );
	$css = $css ? $css : get_template_directory_uri() . '/style.css';
	return apply_filters( 'tamatebako_get_parent_stylesheet_uri', $css );
}

/**
 * Maybe Enqueue Style
 * Enqueue Style if the style is registered.
 * This function is probably not needed since wp will not produce error when we do this.
 *
 * @since 3.1.0
 *
 * @param string $handle Style handle.
 * @return bool True on success or false on failure.
 */
function tamatebako_maybe_enqueue_style( $handle ) {
	if ( wp_style_is( sanitize_key( $handle ), 'registered' ) ) {
		wp_enqueue_style( sanitize_key( $handle ) );
		return true;
	}
	return false;
}

/**
 * Maybe Enqueue Script
 * Enqueue Script if the script is registered.
 * This function is probably not needed since wp will not produce error when we do this.
 *
 * @since 3.1.0
 *
 * @param string $handle Script handle.
 * @return bool True on success or false on failure.
 */
function tamatebako_maybe_enqueue_script( $handle ) {
	if ( wp_script_is( sanitize_key( $handle ), 'registered' ) ) {
		wp_enqueue_script( sanitize_key( $handle ) );
		return true;
	}
	return false;
}

/**
 * Helper function to check script debug.
 *
 * @since 3.0.0
 *
 * @return bool
 */
function tamatebako_is_debug() {
	$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? true : false;
	return apply_filters( 'tamatebako_is_debug', $debug );
}

/**
 * Get parent theme assets file.
 * Return empty file not exist.
 * Also Search for minified version of the file and load it when needed.
 *
 * @since  3.0.0
 *
 * @param  string  $file      File path to load relative to theme directory uri.
 * @param  string  $ext       File extension, e.g "js" or "css".
 * @return string
 */
function tamatebako_theme_file( $file, $ext ) {

	$path = trailingslashit( get_template_directory() ) . $file;
	$uri = trailingslashit( get_template_directory_uri() ) . $file;
	$file_uri = '';

	// If "regular" file exist, use it.
	if ( file_exists(  $path . '.' . $ext ) ) {
		$file_uri = $uri . '.' . $ext;
	}

	// If not debug & min file exist, use it.
	if ( ! tamatebako_is_debug() && file_exists(  $path . '.min.' . $ext ) ) {
		$file_uri = $uri . '.min.' . $ext;
	}

	return $file_uri;
}

/**
 * Get active theme assets file.
 * This function is created for getting child theme file.
 * Return empty if file not exist.
 * Also Search for minified version of the file and load it when needed.
 *
 * @since  3.0.0
 *
 * @param  string $file File path to load relative to child theme directory.
 * @param  string $ext  File extension, e.g "js" or "css".
 * @return string
 */
function tamatebako_child_theme_file( $file, $ext ) {

	$path = trailingslashit( get_stylesheet_directory() ) . $file;
	$uri = trailingslashit( get_stylesheet_directory_uri() ) . $file;
	$file_uri = '';

	// If "regular" file exist.
	if( file_exists(  $path . '.' . $ext ) ){
		$file_uri = $uri . '.' . $ext;
	}

	// If not debug & min file exist, use it.
	if ( ! tamatebako_is_debug() && file_exists(  $path . '.min.' . $ext ) ) {
		$file_uri = $uri . '.min.' . $ext;
	}

	return $file_uri;
}

/**
 * Check Minimum System Requirement.
 *
 * @since 3.0.0
 *
 * @param array $data Theme supports data.
 * @return bool
 */
function tamatebako_minimum_requirement( $data = array() ) {
	global $wp_version;

	// if system have min req (WP & PHP), return true.
	if ( version_compare( $wp_version, $data['wp_requires'], '>=' ) && version_compare( PHP_VERSION, $data['php_requires'], '>=' ) ) {
		return true;
	}

	// Fail requirement.
	return false;
}

/**
 * Google Font URL : Combine multiple google font in one URL
 *
 * @since 3.0.0
 * @link https://shellcreeper.com/how-to-load-multiple-google-font-in-one-url-request/
 *
 * @param array $fonts Fonts name as key and weight/style (array or comma separated string) as value.
 * @param mixed $subsets Array/comma separated string of subsets to load.
 * @return string
 */
function tamatebako_google_fonts_url( $fonts, $subsets = array() ) {
	$base_url    =  "//fonts.googleapis.com/css";
	$font_args   = array();
	$family      = array();

	// Format each font family in array.
	foreach ( $fonts as $font_name => $font_weight ) {
		$font_name = str_replace( ' ', '+', $font_name );
		if ( !empty( $font_weight ) ) {
			if ( is_array( $font_weight ) ) {
				$font_weight = implode( ',', $font_weight );
			}
			$family[] = trim( $font_name . ':' . urlencode( trim( $font_weight ) ) );
		} else {
			$family[] = trim( $font_name );
		}
	}

	// Only return URL if font family defined.
	if ( ! empty( $family ) ) {

		// Make Font Family a String.
		$family = implode( '|', $family );

		// Add font family in args.
		$font_args['family'] = $family;

		// Add font subsets in args.
		if ( ! empty( $subsets ) ) {

			// Format subsets to string.
			if ( is_array( $subsets ) ) {
				$subsets = implode( ',', $subsets );
			}

			$font_args['subset'] = urlencode( trim( $subsets ) );
		}

		return add_query_arg( $font_args, $base_url );
	}

	return '';
}
