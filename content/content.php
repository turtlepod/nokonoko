<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrap">

		<header class="entry-header">
			<?php tamatebako_entry_title(); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php tamatebako_entry_taxonomies(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry > .wrap -->

</article><!-- .entry -->