<article itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<div class="entry-header">

			<?php the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<div class="entry-byline">

				<span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><?php the_author_posts_link(); ?></span>

				<time class="entry-published updated" datetime="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>"><?php echo get_the_date(); ?></time>

				<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>

			</div><!-- .entry-byline -->

		</div><!-- .entry-header -->

		<div class="entry-summary" itemprop="description">
			<?php //get_the_image( array( 'attachment' => false, 'image_class' => 'alignright' ) ); ?>
			<?php the_excerpt(); ?>
			<?php tamatebako_read_more(); ?>
		</div><!-- .entry-summary -->

		<div class="entry-footer">
			<?php edit_post_link(); ?>
			<?php tamatebako_entry_terms(); ?>
		</div><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->
