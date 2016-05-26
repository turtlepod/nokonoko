<?php

if ( tamatebako_is_menu_registered( 'footer' ) ){

	wp_nav_menu(
		array(
			'theme_location'  => 'footer',
			'container'       => '',
			'depth'           => 1,
			'menu_id'         => 'menu-footer-items',
			'menu_class'      => 'menu-items',
			'fallback_cb'     => '__return_false',
			'items_wrap'      => '<nav role="navigation" class="menu" id="menu-footer"><div class="menu-container"><div class="wrap"><ul id="%s" class="%s">%s</ul></div></div></nav>',
		)
	);

}
