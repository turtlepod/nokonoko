<?php
/**
 * Content
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
				<h1 class="entry-title"><?php echo tamatebako_string( 'error_title' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content" itemprop="text">
				<?php echo wpautop( tamatebako_string( 'error_message' ) ); ?>
			</div><!-- .entry-content -->

		</div><!-- .entry-wrap -->
	</article><!-- .entry -->
</div><!-- .content-entry-wrap -->
<?php
}


/**
 * Entry Terms
 * a helper function to print all taxonomy/term attach to a post.
 *
 * @since 0.1.0
 */
function tamatebako_entry_terms(){

	/* Entry Taxonomies */
	$entry_taxonomies = array();

	/* Get Taxonomies Object */
	$entry_taxonomies_obj = get_object_taxonomies( get_post_type(), 'object' );
	foreach ( $entry_taxonomies_obj as $entry_tax_id => $entry_tax_obj ){

		/* Only for public taxonomy */
		if ( 1 == $entry_tax_obj->public ){
			$entry_taxonomies[$entry_tax_id] = array(
				'taxonomy' => $entry_tax_id,
				'text' => $entry_tax_obj->labels->name,
			);
		}
	}

	/* If taxonomies not empty */
	if ( !empty( $entry_taxonomies ) ){ ?>
		<div class="entry-meta">
		<?php foreach ( $entry_taxonomies as $tax_id => $entry_tax ){ ?>
			<?php echo tamatebako_entry_taxonomy( array( 'taxonomy' => $tax_id, 'text' => '<span class="term-name">' . $entry_tax['text'] . '</span>' . ' %s' ) ); ?>
		<?php }//end foreach ?>
		</div>

	<?php } //end empty check
}

/**
 * This template tag is meant to replace template tags like `the_category()`, `the_terms()`, etc.
 */
function tamatebako_entry_taxonomy( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span %s>%s</span>',
		/* Translators: Separates tags, categories, etc. when displaying a post. */
		'sep'        => ', ',
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	/* Attr */
	$attr_string = '';
	$attr = array();
	$attr['class'] = 'entry-terms ' . sanitize_html_class( $args['taxonomy'] );
	if ( 'category' === $args['taxonomy'] ){
		$attr['itemprop'] = 'articleSection';
	}
	elseif ( 'post_tag' === $args['taxonomy'] ){
		$attr['itemprop'] = 'keywords';
	}
	foreach ( $attr as $name => $value ){
		$attr_string .= trim( !empty( $value ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : esc_html( " {$name}" ) );
	}

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], $attr_string, sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

/**
 * Next Previous Post (Loop Nav)
 *
 * @since 0.1.0
 */
function tamatebako_entry_nav(){
?>
<div class="loop-nav">
	<?php previous_post_link( '<div class="prev"><span class="screen-reader-text">' . tamatebako_string( 'previous_post' ) . ':</span> %link</div>', '%title' ); ?>
	<?php next_post_link( '<div class="next"><span class="screen-reader-text">' . tamatebako_string( 'next_post' ) . ':</span> %link</div>', '%title' ); ?>
</div><!-- .loop-nav -->
<?php
}





/**
 * Tamatebako Read More
 * Can be added after "the_excerpt()"
 * 
 * @since 0.1.0
 */
function tamatebako_read_more() {
	$string = tamatebako_string( 'read-more' );
	$read_more = '';
	if ( !empty( $string ) ){
		$read_more = '<span class="more-link-wrap"><a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $string . '</span> <span class="screen-reader-text">' . get_the_title() . '</span></a></span>';
	}
	echo $read_more;
}


/**
 * Entry Permalink
 * General link to the post/entry.
 *
 * @since 0.1.0
 */
function tamatebako_entry_permalink(){
?>
<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php echo tamatebako_string( 'permalink' ); ?></a>
<?php
}

