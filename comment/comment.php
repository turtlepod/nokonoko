<li id="comment-<?php comment_ID(); ?>" <?php comment_class()?>>

	<?php echo tamatebako_get_comment_parent_link(); ?>

	<article class="comment-wrap">

		<header class="comment-meta">

			<?php echo get_avatar( $comment ); ?>

			<div class="wrap">

				<cite class="comment-author vcard"><?php comment_author_link(); ?></cite>
				<?php edit_comment_link(); ?>

				<div class="comment-byline">

					<a class="comment-permalink" href="<?php echo esc_url( get_comment_link() ); ?>"><time class="comment-published" datetime="<?php echo get_comment_time( 'Y-m-d\TH:i:sP' );?>"><?php printf( '%1$s (%2$s)', get_comment_date(), get_comment_time() ) ?></time></a>

				</div><!-- .comment-byline -->

			</div><!-- .comment-meta > .wrap -->

		</header><!-- .comment-meta -->

		<div class="comment-content">
			<?php if( '0' == $comment->comment_approved ){ ?>
				<?php tamatebako_comment_moderation_message(); ?>
			<?php } ?>
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php echo tamatebako_get_comment_reply_link(); ?>

	</article><!-- .comment-wrap -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>