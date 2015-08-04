<?php
/**
 * General Template Tags
 * @since 3.0.0
**/

/**
 * Loads a template based off the post type and/or the post format.
 * @since  0.1.0
 */
function tamatebako_get_template( $dir = 'content' ) {

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

	/* Page Template. */
	if ( 'page' === $post_type ) {
		if( get_page_template_slug() ){
			$page_template = str_replace( '.php', '', basename( get_page_template_slug() ) );
			$templates[] = "{$dir}/page-singular-{$page_template}.php";
		}
	}

	/* Fallback 'content.php' template. */
	$templates[] = "{$dir}/content{$singular}.php";
	$templates[] = "{$dir}/content.php";

	/* Remove Duplicates. */
	$templates = array_unique( $templates );

	/* Apply filters and return the found content template. */
	include( locate_template( $templates, false, false ) );
}

/**
 * Archive Header
 * Display archive title and description.
 * @since  0.1.0
 * @access public
 */
function tamatebako_archive_header(){
	if ( get_the_archive_title() && !is_front_page() && !is_singular() && !is_404() ){
?>
	<header class="archive-header">
		<?php the_archive_title( '<h1 class="archive-title">', '</h1>'); ?>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header><!-- .loop-meta -->
<?php
	}
}

/**
 * Archive Footer
 * Display posts pagination in archive pages.
 * @since 0.1.0
 * @access public
 */
function tamatebako_archive_footer(){
	if ( is_home() || is_archive() || is_search() ){
		the_posts_pagination( array(
			'mid_size' => 3,
			'prev_text' => '<span class="screen-reader-text">' . tamatebako_string( 'previous_posts' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . tamatebako_string( 'next_posts' ) . '</span>',
		) );
	}
}

/**
 * Do Content
 * this will parse a string and add content-like functionality such as autoembed autop etc.
**/
function tamatebako_do_content( $content ){
	if( $content ){
		global $wp_embed;
		$content = $wp_embed->run_shortcode( $content );
		$content = $wp_embed->autoembed( $content );
		$content = wptexturize( $content );
		$content = convert_smilies( $content );
		$content = convert_chars( $content );
		$content = wpautop( $content );
		$content = wptexturize( $content );
		$content = do_shortcode( $content );
		$content = shortcode_unautop( $content );
	}
	return $content;
}
