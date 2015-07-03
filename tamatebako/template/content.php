<?php
/**
 * Content
 * 
 * 
**/

/**
 * Loads a post content template based off the post type and/or the post format.
 *
 * @since  0.1.0
 */
function tamatebako_get_template( $dir ) {

	/* Filter Dir */
	$dir = apply_filters( 'tamatebako_get_template_dir', $dir );

	/* Set up an empty array and get the post type. */
	$templates = array();
	$post_type = get_post_type();

	/* Singular suffix. */
	$singular = '';
	if ( is_singular( $post_type ) ){
		$singular = '-singular';
	}

	/* Assume the theme developer is creating an attachment template. */
	if ( 'attachment' === $post_type ) {
		remove_filter( 'the_content', 'prepend_attachment' );

		$mime_type = get_post_mime_type();

		list( $type, $subtype ) = false !== strpos( $mime_type, '/' ) ? explode( '/', $mime_type ) : array( $mime_type, '' );

		$templates[] = "{$dir}/attachment-{$type}{$singular}.php";
		$templates[] = "{$dir}/attachment-{$type}.php";
	}

	/* If the post type supports 'post-formats', get the template based on the format. */
	if ( current_theme_supports( 'post-formats' ) && post_type_supports( $post_type, 'post-formats' ) ) {

		/* Get theme post format support. */
		$theme_support_format = get_theme_support( 'post-formats' );

		/* Only if theme support specific format */
		if ( is_array( $theme_support_format[0] ) ){

			/* Get the post format. */
			$post_format = get_post_format() ? get_post_format() : 'standard';

			if ( in_array( $post_format, $theme_support_format[0] ) ){

				/* Template based off post type and post format. */
				$templates[] = "{$dir}/{$post_type}-format-{$post_format}{$singular}.php";
				$templates[] = "{$dir}/{$post_type}-format{$singular}.php";
				$templates[] = "{$dir}/{$post_type}-format-{$post_format}.php";

				/* Template based off the post format. */
				$templates[] = "{$dir}/format-{$post_format}{$singular}.php";
				$templates[] = "{$dir}/format{$singular}.php";
				$templates[] = "{$dir}/format-{$post_format}.php";
			}
		}
	}

	/* Template based off the post type. */
	$templates[] = "{$dir}/{$post_type}{$singular}.php";
	$templates[] = "{$dir}/{$post_type}.php";

	/* Fallback 'content.php' template. */
	$templates[] = "{$dir}/content{$singular}.php";
	$templates[] = "{$dir}/content.php";

	/* Remove Duplicates. */
	$templates = array_unique( $templates );

	/* Apply filters and return the found content template. */
	include( locate_template( $templates, false, false ) );
}


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

