<footer id="footer">

	<div class="wrap">

		<p class="footer-content">
			<a class="site-link" title="<?php echo esc_attr( strip_tags( get_bloginfo( 'name' ) ) ); ?>" href="<?php echo esc_url( user_trailingslashit( home_url() ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> &#169; <?php echo date_i18n( 'Y' ); ?>
			<?php get_template_part( 'menu/footer' ); ?>
		</p><!-- .credit -->

	</div><!-- .wrap -->

</footer><!-- #footer -->
