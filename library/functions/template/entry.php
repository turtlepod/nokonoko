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
	<article id="post-0" class="entry">
		<div class="wrap">

			<header class="entry-header">
				<h1 class="entry-title"><?php echo tamatebako_string( 'error_title' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php echo wpautop( tamatebako_string( 'error_message' ) ); ?>
			</div><!-- .entry-content -->

		</div><!-- .entry > .wrap -->
	</article><!-- .entry -->
<?php
}

/**
 * Entry Taxonomies
 * a helper function to print all taxonomy/term attach to a post.
 * @since 3.0.0
 */
function tamatebako_entry_taxonomies( $args = array() ){

	/* Entry Taxonomies */
	$entry_taxonomies = array();

	/* Get Taxonomies Object */
	$entry_taxonomies_obj = get_object_taxonomies( get_post_type(), 'object' );
	foreach ( $entry_taxonomies_obj as $entry_tax_id => $entry_tax_obj ){

		/* Only for public taxonomy */
		if ( 1 == $entry_tax_obj->public ){
			$entry_taxonomies[] = $entry_tax_id;
		}
	}

	/* If taxonomies not empty, display it. */
	if ( !empty( $entry_taxonomies ) ){ ?>
		<div class="entry-taxonomies">
			<?php foreach ( $entry_taxonomies as $entry_taxonomy ){
				$args['taxonomy'] = $entry_taxonomy;
				tamatebako_entry_taxonomy( $args );
			} //end foreach ?>
		</div><!-- .entry-taxonomies -->

	<?php } //end empty check
}

/**
 * This template tag is meant to replace template tags like `the_category()`, `the_terms()`, etc.
 * @since     3.0.0
 */
function tamatebako_entry_taxonomy( $args = array() ) {

	/* Args */
	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s', /* %s will be replaced with taxonomy name (label) */
		'sep'        => ', ',
	);
	$args = wp_parse_args( $args, $defaults );

	/* Get Terms List */
	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	/* Display output only if terms available. */
	if ( !empty( $terms ) ) {
		$tax_labels = get_taxonomy_labels( get_taxonomy( $args['taxonomy'] ) );
		$tax_name = $tax_labels->name;
		$text = sprintf( $args['text'], $tax_name );
	?>
		<span class="entry-terms <?php echo sanitize_html_class( $args['taxonomy'] ); ?>">
			<?php if( !empty( $text ) ){ ?>
			<span class="entry-taxonomy-text"><?php echo $text;?></span> 
			<?php } ?>
			<?php echo $terms; ?>
		</span>
	<?php
	}
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