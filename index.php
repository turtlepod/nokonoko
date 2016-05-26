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

			<div id="main">

				<div class="wrap">

					<main id="content" class="content" role="main">

						<?php if ( have_posts() ){ /* Posts Found */ ?>

							<?php tamatebako_archive_header(); ?>

							<div class="wrap">

								<?php while ( have_posts() ) {  /* Start Loop */ ?>

									<?php the_post(); /* Load Post Data */ ?>

									<?php /* Start Content */ ?>
									<?php tamatebako_get_template( 'content' ); // Loads the content/*.php template. ?>
									<?php /* End Content */ ?>

								<?php } /* End Loop */ ?>

							</div><!-- #content > .wrap -->

							<?php tamatebako_archive_footer(); ?>

						<?php } else { /* No Posts Found */ ?>

							<div class="wrap">
								<?php tamatebako_content_error(); ?>
							</div><!-- #content > .wrap -->

						<?php } /* End Posts Found Check */ ?>

					</main><!-- #content -->

					<?php tamatebako_get_sidebar( 'primary' ); ?>

				</div><!-- #main > .wrap -->

			</div><!-- #main -->

		</div><!-- #container > .wrap -->

		<?php get_footer(); ?>

	</div><!-- #container -->

	<?php wp_footer();?>

</body>
</html>