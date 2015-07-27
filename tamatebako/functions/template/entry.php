<?php
/**
 * Entry (content) Tamplate Tags.
 * @since 3.0.0
**/

/**
 * Entry Title
 * Use <h1> for singular page, and <h2> for archive.
 */
function tamatebako_entry_title(){
	$tag = is_singular() ? 'h1' : 'h2';
	the_title( '<' . $tag . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' . $tag . '>' );
}


/**
 * Entry Date
 */
function tamatebako_entry_date( $permalink = true, $date_format = '' ){

	/* Default time markup */
	$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';

	/* If the post has been modified, display "updated" time. */
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	/* Format it. */
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date( $date_format ),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date( $date_format )
	);

	if( $permalink ){
		echo '<span class="entry-date entry-date-permalink"><a href=" ' . esc_url( get_permalink() ) . '" rel="bookmark">'  . $time_string . '</a></span>';
	}
	else{
		echo '<span class="entry-date">' . $time_string . '</span>';
	}
}


/**
 * Comments Link
 */
function tamatebako_comments_link(){

	/* Vars */
	$id = get_the_ID();
	$title = get_the_title();
	$number = get_comments_number( $id );

	/* If no comment added, and comments is closed do not display link to comment. */
	if ( 0 == $number && !comments_open() && !pings_open() ) {
		return;
	}

	/* In Password Protected Post, add span wrapper. */
	 if ( post_password_required() ) {
		echo '<span class="comments-link"><span class="screen-reader-text">';
		comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' );
		echo '</span></span>';
		return;
	}

	/* Display comments link as default. */
	comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' );
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

			<div class="entry-content">
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
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @since     3.0.0
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
 * @since 0.1.0
 */
function tamatebako_entry_nav(){
?>
<nav class="post-navigation">
	<?php previous_post_link( '<div class="nav-prev"><span class="screen-reader-text">' . tamatebako_string( 'previous_post' ) . ':</span> %link</div>', '%title' ); ?>
	<?php next_post_link( '<div class="nav-next"><span class="screen-reader-text">' . tamatebako_string( 'next_post' ) . ':</span> %link</div>', '%title' ); ?>
</nav><!-- .post-navigation -->
<?php
}

/**
 * Tamatebako Read More
 * Can be added after "the_excerpt()"
 * @since 0.1.0
 */
function tamatebako_read_more() {
	$string = tamatebako_string( 'read_more' );
	$read_more = '';
	if ( !empty( $string ) ){
		$read_more = '<span class="more-link-wrap"><a class="more-link" href="' . esc_url( get_permalink() ) . '"><span class="more-text">' . $string . '</span> <span class="screen-reader-text">' . get_the_title() . '</span></a></span>';
	}
	echo $read_more;
}


/**
 * Entry Permalink
 * General link to the post/entry.
 * @since 0.1.0
 */
function tamatebako_entry_permalink(){
?>
<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark"><span><?php echo tamatebako_string( 'permalink' ); ?></span></a>
<?php
}