<?php
$attachment_itemtype = 'http://schema.org/CreativeWork';
if( wp_attachment_is_image() ){
	$attachment_itemtype = 'http://schema.org/ImageObject';
}
if( tamatebako_attachment_is_audio() ){
	$attachment_itemtype = 'http://schema.org/AudioObject';
}
if( tamatebako_attachment_is_video() ){
	$attachment_itemtype = 'http://schema.org/VideoObject';
}
?>
<article itemtype="<?php echo esc_attr( $attachment_itemtype ); ?>" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" itemprop="headline"><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php tamatebako_attachment(); ?>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php //tamatebako_entry_terms(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-wrap -->

</article><!-- .entry -->

<?php //if ( is_attachment() ) comments_template( '', true ); // Load comments. ?>