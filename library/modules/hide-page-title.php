<?php
/**
 * Option to Hide Page Title in Single Page View
 * This option is added as checkbox after the page title input in page edit screen.
 * @since 3.2.0
**/

/**
 * Hide Page Title Args
 */
function tamatebako_hide_page_title_args(){

	/* Get theme support */
	$hpt_support = get_theme_support( 'tamatebako-hide-page-title' );
	$theme_args = array();
	if ( isset( $hpt_support[0] ) ){
		$theme_args = $hpt_support[0];
	}

	/* Default Args */
	$defaults_args = array( 
		'label' => 'Hide title in single page?',
	);

	/* Logo Args. */
	$args = wp_parse_args( $theme_args, $defaults_args );
	return $args;
}

/* Add Checkbox After Page Title Input */
add_action( 'edit_form_before_permalink', 'tamatebako_hide_page_title_add_input', 5, 2 );

/**
 * Add Checkbox
 */
function tamatebako_hide_page_title_add_input( $post ){
	if( 'page' != get_post_type( $post ) ) return;
	$hpt_args = tamatebako_hide_page_title_args();
?>
	<label for="tamatebako-hide-page-title" style="display:inline-block;margin-top:5px;padding:0 10px;cursor:pointer;">
		<input type="checkbox" value="1" id="tamatebako-hide-page-title" name="tamatebako_hide_page_title" <?php checked( get_post_meta( $post->ID, 'tamatebako_hide_page_title', true ), 1 ); ?> >
		<?php echo $hpt_args['label']; ?>
		<?php wp_nonce_field( "tamatebako_hpt_nonce", "tamatebako_hide_page_title_nonce" ) ?>
	</label>
<?php
}


/* === SAVING META BOX DATA === */
add_action( 'save_post', 'tamatebako_hide_page_title_save_post' );

/**
 * Save Meta Data
 */
function tamatebako_hide_page_title_save_post( $post_id ){
	/* Verify nonce */
	if ( ! isset( $_POST['tamatebako_hide_page_title_nonce'] ) || ! wp_verify_nonce( $_POST['tamatebako_hide_page_title_nonce'], 'tamatebako_hpt_nonce' ) ){
		return $post_id;
	}
	/* Do not save on autosave */
	if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	/* Check post type and user caps. */
	if ( 'page' != $_POST['post_type'] || !current_user_can( 'edit_pages', $post_id ) ) {
		return $post_id;
	}
	$name = 'tamatebako_hide_page_title';
	$old_meta = get_post_meta( $post_id, $name, true );
	$new_meta = isset( $_POST[$name] ) ? '1' : null;
	if( empty( $new_meta ) ){
		delete_post_meta( $post_id, $name );
	}
	elseif( $new_meta != $old_meta ){
		update_post_meta( $post_id, $name, esc_attr( $new_meta ) );
	}

}

