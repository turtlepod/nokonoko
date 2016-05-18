<footer id="footer">

	<?php get_template_part( 'menu/footer' ); ?>

	<div class="wrap">

		<p class="copyright">
			<a class="site-link" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name' ); ?></a> &#169; <?php echo date_i18n( 'Y' ); ?>
		</p>

	</div>

</footer><!-- #footer -->