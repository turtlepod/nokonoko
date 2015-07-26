<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<header class="entry-header">

			<?php tamatebako_entry_title(); ?>

			<div class="entry-byline">

				<span class="entry-author"><?php the_author_posts_link(); ?></span>

				<time class="entry-published updated" datetime="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>"><?php echo get_the_date(); ?></time>

				<?php tamatebako_comments_link(); ?>
 
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div class="entry-summary">

			<?php if ( has_post_thumbnail() ) { ?>
				<a class="theme-thumbnail-link" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
				</a>
			<?php } ?>
			<?php //get_the_image( array( 'attachment' => false, 'image_class' => 'theme-thumbnail' ) ); ?>

			<?php the_excerpt(); ?>
			<?php tamatebako_read_more(); ?>

		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php tamatebako_entry_terms(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->
