<footer itemtype="http://schema.org/WPFooter" itemscope="itemscope" role="contentinfo" id="footer">

	<div class="wrap">

		<p class="credit">
			<a class="site-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> &#169; <?php echo date_i18n( 'Y' ); ?>
			<?php get_template_part( 'menu/footer' ); ?>
		</p><!-- .credit -->

	</div><!-- .wrap -->

</footer><!-- #footer -->
