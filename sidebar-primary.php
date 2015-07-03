<?php
if ( strpos( get_theme_mod( 'theme_layout' ),'sidebar1' ) === false) {
	return false;
}
?>

<div id="sidebar-primary-wrap">

	<aside itemtype="http://schema.org/WPSideBar" itemscope="itemscope" aria-label="Sidebar 1 Sidebar" role="complementary" class="sidebar" id="sidebar-primary">

		<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

			<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

		<?php else : // If the sidebar has no widgets. ?>

			<?php the_widget( 'WP_Widget_Recent_Posts',
				array(
					'number' => 5,
				),
				array(
					'before_widget' => '<section class="widget widget_recent_entries">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>'
				)
			); ?>

		<?php endif; // End widgets check. ?>

	</aside><!-- #sidebar-primary -->

</div>