<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrap">

		<header class="entry-header">
			<?php tamatebako_entry_title(); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php tamatebako_attachment(); ?>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry > .wrap -->

</article><!-- .entry -->

<?php if ( is_attachment() ) comments_template( '', true ); // Load comments. ?>