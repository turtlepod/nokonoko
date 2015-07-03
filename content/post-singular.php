<article itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title" itemprop="headline"><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h1>' ); ?>

			<div class="entry-byline">

				<span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><?php the_author_posts_link(); ?></span>

				<time class="entry-published updated" datetime="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?phpecho get_the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'hybrid-core' ) );?>"><?php echo get_the_date(); ?></time>

				<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>

			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div class="entry-content" itemprop="articleBody">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php //tamatebako_entry_terms(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->

<?php //tamatebako_entry_nav(); ?>

<?php //comments_template( '', true ); // Load comments. ?>