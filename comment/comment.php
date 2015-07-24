<li id="comment-<?php comment_ID(); ?>" <?php comment_class()?>>

	<div class="comment-wrap">

		<div class="comment-meta">

			<?php echo get_avatar( $comment ); ?>

			<cite class="comment-author"><?php comment_author_link(); ?></cite><br />

			<time class="comment-published" datetime="<?php echo get_comment_time( 'Y-m-d\TH:i:sP' );?>"><?php printf( '%1$s (%2$s)', get_comment_date(), get_comment_time() ) ?></time>

			<a class="comment-permalink" href="<?php echo esc_url( get_comment_link() ); ?>">#</a>

			<?php edit_comment_link(); ?>

		</div><!-- .comment-meta -->

		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php echo tamatebako_get_comment_reply_link(); ?>

	</div><!-- .comment-wrap -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>