<article itemprop="blogPost" itemtype="http://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<div class="entry-header">
			<?php the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
		</div><!-- .entry-header -->

		<div class="entry-summary" itemprop="description">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="entry-footer">
			<?php edit_post_link(); ?>
			<?php //tamatebako_entry_terms(); ?>
		</div><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->