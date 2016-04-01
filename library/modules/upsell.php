<?php
/**
 * Upsell to Pro Version Of The Theme
 * @since 3.2.0
**/

/**
 * Upsell Args
 */
function tamatebako_upsell_args(){

	/* Get theme support */
	$upsell_support = get_theme_support( 'tamatebako-upsell' );
	$theme_args = array();
	if ( isset( $upsell_support[0] ) ){
		$theme_args = $upsell_support[0];
	}

	/* Default Args */
	$defaults_args = array( 
		'theme_name'          => '',
		'theme_price'         => '',
		'upgrade_url'         => '',
		'redirect'            => false,
	);

	/* Logo Args. */
	$args = wp_parse_args( $theme_args, $defaults_args );
	return $args;
}

/* ===== CREATE ADMIN PAGE ===== */

/* Hook to admin menu */
add_action( 'admin_menu', 'tamatebako_upsell_admin_menu' );

/**
 * Create Menu Page
 * @since 3.2.0
 */
function tamatebako_upsell_admin_menu(){

	/* Config */
	$upsell_args = tamatebako_upsell_args();
	$menu_title = $upsell_args['theme_name'];
	if( $upsell_args['theme_price'] ){
		$menu_title .= ' <span class="update-plugins"><span class="pending-count">' . $upsell_args['theme_price'] . '</span></span>';
	}

	/* Get theme data */
	$admin_page = add_theme_page(
		$upsell_args['theme_name'],
		$menu_title,
		'edit_theme_options',
		'tamatebako_theme_upgrade',
		'tamatebako_upsell_admin_html'
	);
	if ( $admin_page ){
		add_action( 'admin_enqueue_scripts', 'tamatebako_upsell_admin_enqueue_scripts' );
	}
}

/**
 * Enqueue Scripts Needed
 * @since 3.2.0
 */
function tamatebako_upsell_admin_enqueue_scripts( $hook_suffix ){

	/* Only in admin page */
	if ( 'appearance_page_tamatebako_theme_upgrade' == $hook_suffix ){

		/* CSS */
		wp_enqueue_style( 'tamatebako-upsell-admin', tamatebako_theme_file( "assets/css/upsell-admin", "css" ), array(), tamatebako_theme_version(), 'all' );

		/* JS */
		wp_enqueue_script( 'tamatebako-upsell-admin', tamatebako_theme_file( "assets/js/upsell-admin", "js" ), array( 'jquery' ), tamatebako_theme_version(), true );
	}
}

/**
 * Admin Page HTML
 * @since 3.2.0
 */
function tamatebako_upsell_admin_html(){
	tamatebako_include( 'includes/upsell-admin' );
}


/* ===== THEME ACTIVATION REDIRECT ===== */

/* Redirect on theme activation */
add_action( 'admin_init', 'tamatebako_upsell_theme_activation_redirect' );

/**
 * Redirect to "Install Plugins" page on activation
 */
function tamatebako_upsell_theme_activation_redirect() {
	$upsell_args = tamatebako_upsell_args();
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) &&  "themes.php" == $pagenow && true === $upsell_args['redirect'] ) {
		wp_redirect( admin_url( 'themes.php?page=tamatebako_theme_upgrade' ) );
	}
}


