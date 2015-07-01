<?php
/**
 * Layouts Post Meta
 * @since 3.0.0
 */

/* === SET LAYOUT === */

/* Filters the theme layout mod. */
add_filter( 'theme_mod_theme_layout', 'tamatebako_set_post_layout' );


/**
 * Filters the 'theme_mods_theme_layout'.
 */
function tamatebako_set_post_layout( $layout ) {
	if ( is_singular() ){
		if ( post_type_supports( get_post_type( get_queried_object_id() ), 'theme-layouts' ) ) {
			$layout = tamatebako_get_post_layout( get_queried_object_id() );
		}
	}
	return $layout;
}


/* === VARS === */

/**
 * Meta Key
 */
function tamatebako_layout_meta_key(){
	return 'Layout';
}

/**
 * Get the post layout based on the given post ID.
 */
function tamatebako_get_post_layout( $post_id = '' ) {
	if( empty( $post_id ) ){
		$post_id = get_queried_object_id();
	}
	$layout = get_post_meta( $post_id, tamatebako_layout_meta_key(), true );
	return ( !empty( $layout ) ? $layout : 'default' );
}


/* === REGISTER META === */

/* Register Meta */
add_action( 'init', 'tamatebako_layouts_register_meta' );

/**
 * Registers the theme layouts meta key 
 */
function tamatebako_layouts_register_meta() {
	register_meta( 'post', tamatebako_layout_meta_key(), 'sanitize_html_class' );
}


/* === POST TYPE SUPPORT === */

/* Add post type support for theme layouts. */
add_action( 'init', 'tamatebako_layouts_add_post_type_support', 5 );

/**
 * Adds post type support to all 'public' post types.
 */
function tamatebako_layouts_add_post_type_support() {
	$post_types = get_post_types( array( 'public' => true ) );
	foreach ( $post_types as $type ){
		add_post_type_support( $type, 'theme-layouts' );
	}
}

/* === META BOX / OPTIONS === */

/* Set up the custom post layouts. */
add_action( 'admin_init', 'tamatebako_layouts_admin_setup' );

/**
 * Setup Layouts Meta Box & Options
 */
function tamatebako_layouts_admin_setup() {

	/* Load the post meta boxes on the new post and edit post screens. */
	add_action( 'load-post.php', 'tamatebako_layouts_load_meta_boxes' );
	add_action( 'load-post-new.php', 'tamatebako_layouts_load_meta_boxes' );

	/* If the attachment post type supports 'theme-layouts', add form fields for it. */
	if ( post_type_supports( 'attachment', 'theme-layouts' ) ) {

		/* Adds a theme layout <select> element to the attachment edit form. */
		add_filter( 'attachment_fields_to_edit', 'tamatebako_layouts_attachment_fields_to_edit', 10, 2 );

		/* Saves the theme layout for attachments. */
		add_filter( 'attachment_fields_to_save', 'tamatebako_layouts_attachment_fields_to_save', 10, 2 );
	}
}

/**
 * Add Meta Boxes and Save Functions
 */
function tamatebako_layouts_load_meta_boxes() {

	/* Add the layout meta box on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'tamatebako_layouts_add_meta_boxes', 10, 2 );

	/* Saves the post format on the post editing page. */
	add_action( 'save_post', 'tamatebako_layouts_save_post', 10, 2 );
	add_action( 'add_attachment', 'tamatebako_layouts_save_post' );
	add_action( 'edit_attachment', 'tamatebako_layouts_save_post' );
}

/**
 * Add Meta Boxes
 */
function tamatebako_layouts_add_meta_boxes( $post_type, $post ) {

	/* Add the meta box if the post type supports 'theme-layouts'. */
	if ( ( post_type_supports( $post_type, 'theme-layouts' ) ) && ( current_user_can( 'edit_post_meta', $post->ID ) || current_user_can( 'add_post_meta', $post->ID ) || current_user_can( 'delete_post_meta', $post->ID ) ) ){

		add_meta_box( 'theme-layouts-post-meta-box', tamatebako_string( 'Layout' ), 'tamatebako_layouts_post_meta_box', $post_type, 'side', 'default' );
	}
}

/**
 * Layout Meta Box Callback Function
 */
function tamatebako_layouts_post_meta_box( $post, $box ) {

	/* Vars */
	$layouts_args = tamatebako_layouts_args();
	$layouts = tamatebako_layouts();
	if( true === $layouts_args['customize'] ){
		$layouts['default'] = tamatebako_string( 'Global Layout' );
	}
	else{
		$layouts['default'] = tamatebako_string( 'Default' );
	}
	$layouts['default'] = $layouts['default'] . ' (' . tamatebako_layout_name( tamatebako_current_layout() ) . ')';

	$post_layout = tamatebako_get_post_layout( $post->ID );
?>

	<div class="post-layout">

		<?php wp_nonce_field( basename( __FILE__ ), 'theme-layouts-nonce' ); ?>

		<div class="post-layout-wrap">
			<ul>
				<?php foreach ( $layouts as $layout => $layout_name ) { ?>
					<li><input type="radio" name="post-layout" id="post-layout-<?php echo esc_attr( $layout ); ?>" value="<?php echo esc_attr( $layout ); ?>" <?php checked( $post_layout, $layout ); ?> /> <label for="post-layout-<?php echo esc_attr( $layout ); ?>"><?php echo esc_html( $layout_name ); ?></label></li>
				<?php } ?>
			</ul>
		</div>
	</div><?php
}

/**
 * Saves the post layout metadata.
 */
function tamatebako_layouts_save_post( $post_id, $post = '' ) {

	/* Fix for attachment save issue in WordPress 3.5. @link http://core.trac.wordpress.org/ticket/21963 */
	if ( !is_object( $post ) ){
		$post = get_post();
	}

	/* Verify the nonce for the post formats meta box. */
	if ( !isset( $_POST['theme-layouts-nonce'] ) || !wp_verify_nonce( $_POST['theme-layouts-nonce'], basename( __FILE__ ) ) ){
		return $post_id;
	}

	/* Get the meta key. */
	$meta_key = tamatebako_layout_meta_key();

	/* Get the previous post layout. */
	$meta_value = tamatebako_get_post_layout( $post_id );

	/* Get the submitted post layout. */
	$new_meta_value = $_POST['post-layout'];

	/* If there is no new meta value but an old value exists, delete it. */
	if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value ){
		delete_post_meta( $post_id, $meta_key );
	}

	/* If a new meta value was added and there was no previous value, add it. */
	elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value ){
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	}

	/* If the old layout doesn't match the new layout, update the post layout meta. */
	elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $meta_value !== $new_meta_value ){
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	}
}

/**
 * Attachment Edit Layout Drop-down
 */
function tamatebako_layouts_attachment_fields_to_edit( $fields, $post ) {

	/* Vars */
	$layouts_args = tamatebako_layouts_args();
	$layouts = tamatebako_layouts();
	if( true === $layouts_args['customize'] ){
		$layouts['default'] = tamatebako_string( 'Global Layout' );
	}
	else{
		$layouts['default'] = tamatebako_string( 'Default' );
	}
	$layouts['default'] = $layouts['default'] . ' (' . tamatebako_layout_name( tamatebako_current_layout() ) . ')';

	/* Get the current post's layout. */
	$post_layout = tamatebako_get_post_layout( $post->ID );

	/* Select */
	$select = '';

	/* Loop through each theme-supported layout, adding it to the select element. */
	foreach ( $layouts as $layout => $layout_name ){
		$select .= '<option id="post-layout-' . esc_attr( $layout ) . '" value="' . esc_attr( $layout ) . '" ' . selected( $post_layout, $layout, false ) . '>' . esc_html( $layout_name ) . '</option>';
	}

	/* Set the HTML for the post layout select drop-down. */
	$select = '<select style="width:100%;" name="attachments[' . $post->ID . '][theme-layouts-post-layout]" id="attachments[' . $post->ID . '][theme-layouts-post-layout]">' . $select . '</select>';

	/* Add the attachment layout field to the $fields array. */
	$fields['theme-layouts-post-layout'] = array(
		'label'         => __( 'Layout', 'theme-layouts' ),
		'input'         => 'html',
		'html'          => $select,
		'show_in_edit'  => false,
		'show_in_modal' => true
	);

	/* Return the $fields array back to WordPress. */
	return $fields;
}

/**
 * Saves the attachment layout for the attachment edit form.
 */
function tamatebako_layouts_attachment_fields_to_save( $post, $fields ) {

	/* If the theme layouts field was submitted. */
	if ( isset( $fields['theme-layouts-post-layout'] ) ) {

		/* Get the meta key. */
		$meta_key = tamatebako_layout_meta_key();

		/* Get the previous post layout. */
		$meta_value = tamatebako_get_post_layout( $post['ID'] );

		/* Get the submitted post layout. */
		$new_meta_value = $fields['theme-layouts-post-layout'];

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'delete_post_meta', $post['ID'], $meta_key ) && '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key );
		}

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'add_post_meta', $post['ID'], $meta_key ) && $new_meta_value && '' == $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}

		/* If the old layout doesn't match the new layout, update the post layout meta. */
		elseif ( current_user_can( 'edit_post_meta', $post['ID'], $meta_key ) && $meta_value !== $new_meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}
	}

	/* Return the attachment post array. */
	return $post;
}
