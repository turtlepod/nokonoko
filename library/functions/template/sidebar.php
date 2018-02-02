<?php
/**
 * Sidebar Tamplate Tags.
 *
 * @since 3.0.0
 * @author GenbuMedia
**/

/**
 * This is a replacement function for the WordPress `get_sidebar()` function.
 * With the ability to add sidebar templates to a sub-directory.
 *
 * @since 0.1.0
 * @author Justin Tadlock <justintadlock@gmail.com>
 *
 * @param string|null $name Sidebar name.
 */
function tamatebako_get_sidebar( $name = null ) {
	do_action( 'get_sidebar', $name ); // Core WordPress hook.

	$templates = array();

	if ( '' !== $name ) {
		$templates[] = "sidebar-{$name}.php";
		$templates[] = "sidebar/{$name}.php";
	}

	$templates[] = 'sidebar.php';
	$templates[] = 'sidebar/sidebar.php';

	locate_template( $templates, true );
}

/**
 * Get Sidebar Name (label) by ID.
 * Helper function to get sidebar name (label) by sidebar ID and use it as sidebar toggle.
 *
 * @since 0.1.0
 *
 * @param string $id Sidebar ID.
 * @return string|false
 */
function tamatebako_get_sidebar_name( $id ) {
	global $wp_registered_sidebars;

	if ( empty( $wp_registered_sidebars ) ) {
		return false;
	}

	if ( isset( $wp_registered_sidebars[ $id ] ) ) {
		if ( isset( $wp_registered_sidebars[ $id ]['name'] ) ) {
			return $wp_registered_sidebars[ $id ]['name'];
		}

		return false;
	}

	return false;
}
