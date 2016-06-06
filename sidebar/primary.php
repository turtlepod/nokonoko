<?php
if ( strpos( get_theme_mod( 'theme_layout' ),'sidebar1' ) === false) {
	return false;
}
?>

<div id="sidebar-primary">

	<aside class="sidebar">

		<?php if ( is_active_sidebar( 'primary' ) ) { ?>

			<?php dynamic_sidebar( 'primary' ); ?>

		<?php } else { ?>

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

		<?php } // end widget check. ?>

	</aside><!-- #sidebar-primary > .sidebar -->

</div><!-- #sidebar-primary -->