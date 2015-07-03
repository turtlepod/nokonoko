<article itemprop="blogPost" itemtype="http://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" itemprop="headline"><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content" itemprop="text">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="wp-link-pages">' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php //tamatebako_entry_terms(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->

<?php comments_template( '', true ); // Load comments. ?>