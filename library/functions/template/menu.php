<?php
/**
 * Navigation Menus Template Functions.
 *
 * @since 3.0.0
 * @author GenbuMedia
**/

/**
 * Get custom menu name by location.
 * Helper function to get menu location and use it as mobile toggle.
 *
 * @since  0.1.0
 * @link   http://wordpress.stackexchange.com/questions/45700
 *
 * @param string $location Menu location.
 * @return string|false
 */
function tamatebako_get_menu_name( $location ) {

	// Get registered nav menu.
	$menus = get_registered_nav_menus();

	// If no menu available, bail early.
	if ( empty( $menus ) ) {
		return false;
	}

	// Check if menu is set.
	if ( has_nav_menu( $location ) ) {

		$locations = get_nav_menu_locations();
		if( ! isset( $locations[ $location ] ) ){
			return false;
		}

		// Return menu name.
		$menu_obj = get_term( $locations[$location], 'nav_menu' );
		return $menu_obj->name;
	}

	return false;
}


/**
 * Check if a custom menu location is registered.
 *
 * @since 0.1.0
 *
 * @param string $location Menu Location.
 * @return bool
 */
function tamatebako_is_menu_registered( $location ) {
	$menus = get_registered_nav_menus();
	return $menus && isset( $menus[ $location ] ) ? true : false;
}

/**
 * Menu Toggle
 *
 * @since 0.1.0
 *
 * @param string $location Menu Location.
 */
function tamatebako_menu_toggle( $location ) {
	?>

	<div id="menu-toggle-<?php echo $location; ?>" class="menu-toggle">
		<a class="menu-toggle-open" href="#menu-<?php echo $location; ?>"><span class="menu-toggle-text screen-reader-text"><?php echo tamatebako_get_menu_name( $location ); ?></span></a>
		<a class="menu-toggle-close" href="#menu-toggle-<?php echo $location?>"><span class="menu-toggle-text screen-reader-text"><?php echo tamatebako_get_menu_name( $location ); ?></span></a>
	</div><!-- .menu-toggle -->

	<?php
}

/**
 * Menu Fallback Callback.
 *
 * Generic menu fallback and only display link to home page.
 *
 * @since 0.1.0
 */
function tamatebako_menu_fallback_cb( $args = array() ) {
	$defaults = array(
		'menu_id'    => 'menu-items',
		'menu_class' => 'menu-items',
	);
	$args = wp_parse_args( $args, $defaults );
	?>

	<div class="wrap">
		<ul id="<?php echo esc_attr( $args['menu_id'] ); ?>" class="<?php echo esc_attr( $args['menu_class'] ); ?>">
			<li class="menu-item">
				<a rel="home" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>"><?php echo tamatebako_string( 'menu_default_home' ); ?></a>
			</li>
		</ul>
	</div>

	<?php
}

/**
 * Menu Footer Fallback Callback.
 *
 * Generic menu fallback and only display link to home page.
 *
 * @since 0.1.0
 */
function tamatebako_menu_footer_fallback_cb() {
	?>

	<div class="wrap">
		<ul class="menu-items" id="menu-items">
			<?php echo tamatebako_menu_copyright_item(); ?>
		</ul>
	</div>

	<?php
}

/**
 * Menu Footer Fallback Callback.
 *
 * Generic menu fallback and only display link to home page.
 *
 * @since 0.1.0
 *
 * @return string
 */
function tamatebako_menu_copyright_item() {
	$copy  = '<li id="menu-copyright" class="menu-item">';
	$copy .= '<span><a class="site-link" rel="home" href="' . esc_url( user_trailingslashit( home_url() ) ) . '">' . get_bloginfo( 'name' ) . '</a> &#169; ' . date_i18n( 'Y' ) . '</span>';
	$copy .= '</li>';
	return $copy;
}

/**
 * Navigation Search Form.
 *
 * @since 0.1.0
 *
 * @param string $id Form ID.
 */
function tamatebako_menu_search_form( $id = 'search-menu' ) {
	?>

	<form role="search" method="get" class="search-form" action="<?php echo esc_attr( home_url( '/' ) ); ?>">
		<a href="#<?php echo esc_attr( $id ); ?>" class="search-toggle"><span class="screen-reader-text"><?php echo tamatebako_string( 'menu_search_form_toggle' ); ?></span></a>
		<input id="<?php echo esc_attr( $id ); ?>" type="search" class="search-field" placeholder="<?php echo tamatebako_string( 'menu_search_placeholder' ); ?>" value="<?php echo is_search() ? esc_attr( strip_tags( get_search_query() ) ) : ''; ?>" name="s"/>
		<button class="search-submit button"><span class="screen-reader-text"><?php echo tamatebako_string('menu_search_button'); ?></span></button>
	</form>

	<?php
}
