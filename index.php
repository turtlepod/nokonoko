<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body itemtype="http://schema.org/WebPage" itemscope="itemscope" <?php body_class(); ?>>

<?php echo tamatebako_check_js_script(); ?>

<div id="container">

	<?php tamatebako_skip_to_content(); ?>

	<?php get_header(); ?>

	<?php get_template_part( 'menu/primary' ); ?>

	<div id="main">

		<div class="main-inner">

			<div class="main-wrap">

				<main itemtype="http://schema.org/Blog" itemscope="" itemprop="mainContentOfPage" role="main" class="content" id="content">

					<?php if ( have_posts() ){ /* Posts Found */ ?>

						<?php //tamatebako_archive_header(); ?>

						<div class="content-entry-wrap">

							<?php while ( have_posts() ) {  /* Start Loop */ ?>

								<?php the_post(); /* Load Post Data */ ?>

								<?php /* Start Content */ ?>
								<?php tamatebako_get_template( 'content' ); // Loads the content/*.php template. ?>
								<?php /* End Content */ ?>

							<?php } /* End Loop */ ?>

						</div><!-- .content-entry-wrap-->

						<?php //tamatebako_archive_footer(); ?>

					<?php } else { /* No Posts Found */ ?>

						<?php tamatebako_content_error(); ?>

					<?php } /* End Posts Found Check */ ?>

				</main><!-- #content -->

				<?php get_sidebar( 'primary' ); ?>

			</div><!-- .main-wrap -->

		</div><!-- .main-inner -->

		<?php get_sidebar( 'secondary' ); ?>

	</div><!-- #main -->

	<?php get_template_part( 'site-footer' ); ?>

</div><!-- #container -->

<?php get_footer(); // Loads the footer.php template. ?>

<?php wp_footer();?>
</body>
</html>