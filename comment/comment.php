<li id="comment-<?php comment_ID(); ?>" itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/UserComments" <?php comment_class()?>>

	<div class="comment-wrap">

		<div class="comment-meta">

			<?php echo get_avatar( $comment ); ?>

			<cite class="comment-author" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person"><?php comment_author_link(); ?></cite><br />

			<time class="comment-published" datetime="<?php echo get_comment_time( 'Y-m-d\TH:i:sP' );?>" title="<?php echo get_comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'hybrid-core' ) ); ?>" itemprop="commentTime"><?php printf( '%1$s (%2$s)', get_comment_date(), get_comment_time() ) ?></time>

			<a class="comment-permalink" href="<?php echo esc_url( get_comment_link() ); ?>" itemprop="url">#</a>

			<?php edit_comment_link(); ?>

		</div><!-- .comment-meta -->

		<div class="comment-content" itemprop="commentText">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php tamatebako_get_comment_reply_link(); ?>

	</div><!-- .comment-wrap -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>