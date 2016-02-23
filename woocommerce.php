<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="container">

		<?php tamatebako_skip_to_content(); ?>

		<?php get_header(); ?>

		<?php get_template_part( 'menu/primary' ); ?>

		<div class="wrap">

			<?php //tamatebako_get_sidebar( 'secondary' ); ?>

			<div id="main">

				<div class="wrap">

					<?php //tamatebako_get_sidebar( 'primary' ); ?>

					<main id="content" class="content" role="main">

							<div class="wrap">

								<?php woocommerce_content(); ?>

							</div><!-- #content > .wrap -->

					</main><!-- #content -->

					<?php tamatebako_get_sidebar( 'primary' ); ?>

				</div><!-- #main > .wrap -->

			</div><!-- #main -->

			<?php tamatebako_get_sidebar( 'secondary' ); ?>

		</div><!-- #container > .wrap -->

		<?php get_footer(); ?>

	</div><!-- #container -->

	<?php wp_footer();?>

</body>
</html>