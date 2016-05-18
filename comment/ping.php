<li id="comment-<?php comment_ID(); ?>" <?php comment_class()?>>

	<article class="comment-wrap">

		<div class="comment-meta">

			<div class="wrap">

				<cite class="comment-author"><?php comment_author_link(); ?></cite><br />

				<div class="comment-byline">

				<a class="comment-permalink" href="<?php echo esc_url( get_comment_link() ); ?>"><time class="comment-published" datetime="<?php echo get_comment_time( 'Y-m-d\TH:i:sP' );?>"><?php printf( '%1$s (%2$s)', get_comment_date(), get_comment_time() ) ?></time></a>

				<?php edit_comment_link(); ?>

				</div><!-- .comment-byline -->

			</div>

		</div><!-- .comment-meta -->

	</article><!-- .comment-wrap -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>