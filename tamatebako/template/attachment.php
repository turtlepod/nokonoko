<?php
/**
 * Attachment
**/

/**
 * Display any type of Attachment
 * @since 0.1.0
 */
function tamatebako_attachment(){
	$file       = wp_get_attachment_url();
	$mime       = get_post_mime_type();
	$attachment = '';

	$mime_type = false !== strpos( $mime, '/' ) ? explode( '/', $mime ) : array( $mime, '' );

	/* Loop through each mime type. If a function exists for it, call it. Allow users to filter the display. */
	foreach ( $mime_type as $type ) {
		if ( function_exists( "tamatebako_attachment_{$type}" ) ){
			$attachment = call_user_func( "tamatebako_attachment_{$type}", $mime, $file );
		}
	}

	echo $attachment;
}


/**
 * Display Attachment Image with caption if available.
 *
 * @since 0.1.0
 */
function tamatebako_attachment_image( $mime = '', $file = '' ){

	/* If image has excerpt / caption. */
	if ( has_excerpt() ) {

		/* Image URL */
		$src = wp_get_attachment_image_src( get_the_ID(), 'full' );
		/* Display image with caption */
		echo img_caption_shortcode( array( 'align' => 'aligncenter', 'width' => esc_attr( $src[1] ), 'caption' => get_the_excerpt() ), wp_get_attachment_image( get_the_ID(), 'full', false ) );

	}
	/* No caption. */
	else {

		/* Display image without caption. */
		echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) );
	}
}


/**
 * Handles application attachments
 */
function tamatebako_attachment_application( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();
	$application  = '<object class="text" type="' . esc_attr( $mime ) . '" data="' . esc_url( $file ) . '" width="' . esc_attr( $embed_defaults['width'] ) . '" height="' . esc_attr( $embed_defaults['height'] ) . '">';
	$application .= '<param name="src" value="' . esc_url( $file ) . '" />';
	$application .= '</object>';

	return $application;
}

/**
 * Handles text attachments on their attachment pages.
 */
function tamatebako_attachment_text( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();
	$text  = '<object class="text" type="' . esc_attr( $mime ) . '" data="' . esc_url( $file ) . '" width="' . esc_attr( $embed_defaults['width'] ) . '" height="' . esc_attr( $embed_defaults['height'] ) . '">';
	$text .= '<param name="src" value="' . esc_url( $file ) . '" />';
	$text .= '</object>';

	return $text;
}

/**
 * Handles the output of the media for audio attachment posts.
 */
function tamatebako_attachment_audio( $mime = '', $file = '' ) {
	return do_shortcode( '[audio src="' . esc_url( esc_url( $file ) ) . '"]' );
}

/**
 * Handles the output of the media for video attachment posts. This should be used within The Loop.
 *
 * @since  0.2.2
 * @access public
 * @return string
 */
function tamatebako_attachment_video( $mime = '', $file = '' ) {
	return do_shortcode( '[video src="' . esc_url( esc_url( $file ) ) . '"]' );
}





/**
 * Checks if the current post has a mime type of 'audio'.
 *
 * @since  1.6.0
 * @access public
 * @param  int    $post_id
 * @return bool
 */
function tamatebako_attachment_is_audio( $post_id = 0 ) {

	$post_id   = empty( $post_id ) ? get_the_ID() : $post_id;
	$mime_type = get_post_mime_type( $post_id );

	list( $type, $subtype ) = false !== strpos( $mime_type, '/' ) ? explode( '/', $mime_type ) : array( $mime_type, '' );

	return 'audio' === $type ? true : false;
}

/**
 * Checks if the current post has a mime type of 'video'.
 *
 * @since  1.6.0
 * @access public
 * @param  int    $post_id
 * @return bool
 */
function tamatebako_attachment_is_video( $post_id = 0 ) {

	$post_id   = empty( $post_id ) ? get_the_ID() : $post_id;
	$mime_type = get_post_mime_type( $post_id );

	list( $type, $subtype ) = false !== strpos( $mime_type, '/' ) ? explode( '/', $mime_type ) : array( $mime_type, '' );

	return 'video' === $type ? true : false;
}



