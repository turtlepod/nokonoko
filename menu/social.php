<?php
/**
 * Social Menu
 * @links http://css-tricks.com/snippets/wordpress/remove-li-elements-from-output-of-wp_nav_menu/
 */
if ( tamatebako_is_menu_registered( 'social' ) ) {
	$args = array(
		'theme_location'  => 'social',
		'container'       => false,
		'echo'            => false,
		'items_wrap'      => '<ul class="social-links social-links-background">%3$s</ul>',
		'depth'           => 1,
		'link_before'     => '<span class="screen-reader-text">',
		'link_after'      => '</span>',
		'fallback_cb'     => '__return_false',
	);
	?>
	<div id="social-links">
		<?php echo wp_nav_menu( $args ); ?>
	</div>
	<?php
}
