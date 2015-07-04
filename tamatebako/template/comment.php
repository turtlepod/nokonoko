<?php
/**
 * Comments
**/

/**
 * Comments Nav
 * @since 0.1.0
 */
function tamatebako_comments_nav(){
?>
<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) { // Check for paged comments. ?>

	<div class="comments-nav">

		<?php previous_comments_link( '<span class="prev-comments"><span class="screen-reader-text">' . tamatebako_string( 'previous' ) . '</span></span>' ); ?>

		<span class="page-numbers"><?php printf( '%1$s / %2$s', get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() ); ?></span>

		<?php next_comments_link( '<span class="next-comments"><span class="screen-reader-text">' . tamatebako_string( 'next' ) . '</span></span>' ); ?>

	</div><!-- .comments-nav -->

<?php } // End check for paged comments. ?>
<?php
}




/**
 * Comments Error
 * used in "comments.php"
 * @since 0.1.0
 */
function tamatebako_comments_error(){
	if( is_page() ){
		return false;
	}
?>
<?php if ( pings_open() && !comments_open() ) { ?>

	<p class="comments-closed pings-open">
		<?php echo tamatebako_string( 'comments-closed-pings-open' ); ?>
	</p><!-- .comments-closed.pings-open -->

<?php } elseif ( !comments_open() ) { ?>

	<p class="comments-closed">
		<?php echo tamatebako_string( 'comments-closed' ); ?>
	</p><!-- .comments-closed -->

<?php } ?>
<?php
}

/**
 * Outputs the comment reply link. 
 */
function tamatebako_get_comment_reply_link( $args = array() ) {

	if ( !get_option( 'thread_comments' ) || in_array( get_comment_type(), array( 'pingback', 'trackback' ) ) ){
		return '';
	}

	$args = wp_parse_args(
		$args,
		array(
			'depth'     => intval( $GLOBALS['comment_depth'] ),
			'max_depth' => get_option( 'thread_comments_depth' ),
		)
	);

	return get_comment_reply_link( $args );
}


/**
 * Uses the $comment_type to determine which comment template should be used. Once the 
 * template is located, it is loaded for use. Child themes can create custom templates based off
 * the $comment_type. The comment template hierarchy is comment-$comment_type.php, 
 * comment.php.
 *
 * The templates are saved in $hybrid->comment_template[$comment_type], so each comment template
 * is only located once if it is needed. Following comments will use the saved template.
 *
 * @since  0.2.3
 * @access public
 * @param  $comment The comment object.
 * @param  $args    Array of arguments passed from wp_list_comments().
 * @param  $depth   What level the particular comment is.
 * @return void
 */
function tamatebako_comments_callback( $comment, $args, $depth ) {

	/* Get the comment type of the current comment. */
	$comment_type = get_comment_type( $comment->comment_ID );

	/* Create an empty array if the comment template array is not set. */
	if ( !isset( $comment_template ) || !is_array( $comment_template ) ){
		$comment_template = array();
	}

	/* Check if a template has been provided for the specific comment type.  If not, get the template. */
	if ( !isset( $comment_template[$comment_type] ) ) {

		/* Create an array of template files to look for. */
		$templates = array( "comment-{$comment_type}.php", "comment/{$comment_type}.php" );

		/* If the comment type is a 'pingback' or 'trackback', allow the use of 'comment-ping.php'. */
		if ( 'pingback' == $comment_type || 'trackback' == $comment_type ) {
			$templates[] = 'comment-ping.php';
			$templates[] = 'comment/ping.php';
		}

		/* Add the fallback 'comment.php' template. */
		$templates[] = 'comment/comment.php';
		$templates[] = 'comment.php';

		/* Allow devs to filter the template hierarchy. */
		$templates = apply_filters( 'hybrid_comment_template_hierarchy', $templates, $comment_type );

		/* Locate the comment template. */
		$template = locate_template( $templates );

		/* Set the template in the comment template array. */
		$comment_template[ $comment_type ] = $template;
	}

	/* If a template was found, load the template. */
	if ( !empty( $comment_template[ $comment_type ] ) ){
		require( $comment_template[ $comment_type ] );
	}
}



/**
 * Ends the display of individual comments. Uses the callback parameter for wp_list_comments(). 
 * Needs to be used in conjunction with hybrid_comments_callback(). Not needed but used just in 
 * case something is changed.
 *
 * @since  0.2.3
 * @access public
 * @return void
 */
function tamatebako_comments_end_callback() {
	echo '</li><!-- .comment -->';
}

