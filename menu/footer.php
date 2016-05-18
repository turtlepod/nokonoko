<nav role="navigation" class="menu" id="menu-footer">

	<div class="menu-container">

		<?php 
		/* Display menu only if the location is registered */
		if ( tamatebako_is_menu_registered( 'footer' ) ){
			wp_nav_menu(
				array(
					'theme_location'  => 'footer',
					'container'       => '',
					'depth'           => 1,
					'menu_id'         => 'menu-footer-items',
					'menu_class'      => 'menu-items',
					'fallback_cb'     => 'tamatebako_menu_fallback_cb',
					'items_wrap'      => '<div class="wrap"><ul id="%s" class="%s">%s</ul></div>'
				)
			);
			
		}
		else{
			tamatebako_menu_fallback_cb();
		}
		?>

	</div><!-- .menu-container -->

</nav><!-- #menu-primary -->