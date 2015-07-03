<li id="comment-<?php comment_ID(); ?>" <?php comment_class()?>>

	<div class="comment-meta">

		<cite class="comment-author" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person"><?php comment_author_link(); ?></cite><br />

		<time class="comment-published" datetime="<?php echo get_comment_time( 'Y-m-d\TH:i:sP' );?>" title="<?php echo get_comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'hybrid-core' ) ); ?>" itemprop="commentTime"><?php printf( '%1$s (%2$s)', get_comment_date(), get_comment_time() ) ?></time>

		<a class="comment-permalink" href="<?php echo esc_url( get_comment_link() ); ?>" itemprop="url">#</a>

		<?php edit_comment_link(); ?>

	</div><!-- .comment-meta -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>