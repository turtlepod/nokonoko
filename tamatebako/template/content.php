<?php
/**
 * Content
 * 
 * 
**/









/**
 * Content Error
 * used in "index.php"
 * @since 0.1.0
 */
function tamatebako_content_error(){
?>
<div class="content-entry-wrap">
	<article id="post-0" class="entry">
		<div class="entry-wrap">

			<header class="entry-header">
				<h1 class="entry-title"><?php echo tamatebako_string( '404 Not Found' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content" itemprop="text">
				<?php echo wpautop( tamatebako_string( 'Apologies, but no entries were found.' ) ); ?>
			</div><!-- .entry-content -->

		</div><!-- .entry-wrap -->
	</article><!-- .entry -->
</div><!-- .content-entry-wrap -->
<?php
}

