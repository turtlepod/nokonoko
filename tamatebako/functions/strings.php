<?php
/**
 * Texts string / translatable string used in tamatebako.
 * To make this string translatable, theme need to filter it using "tamatebako_strings",
 * and wrap it using translation functions.
 * @since  3.0.0
 * @param  string  $context   Text identifier.
 * @access private
 * @return string
 */
function tamatebako_string( $context ){

	/* tamatebako object */
	global $tamatebako;

	/* If text found, return it. */
	if ( isset( $tamatebako->strings[$context] ) ){
		return $tamatebako->strings[$context];
	}
	/* Not found, use default. */
	else{
		$texts = tamatebako_strings();
		if ( isset( $texts[$context] ) ){
			return $texts[$context];
		}
		return $context;
	}
}

/**
 * Lists of translatable texts string used in the framework
 * @since 3.0.0
 */
function tamatebako_strings(){

	/* Open sesame! */
	$texts = array(

		/* layouts */
		'default' => 'Default',
		'layout' => 'Layout',
		'global_layout' => 'Global Layout',

		/* template/accessibility.php */
		'skip_to_content' => 'Skip to content',

		/* template/general.php */
		'next_posts' => 'Next',
		'previous_posts' => 'Previous',
		'search_title_prefix' => 'Search results for',

		/* template/menu.php */
		'menu_search_placeholder' => 'Search&hellip,',
		'menu_search_button' => 'Search',
		'menu_search_form_toggle' => 'Expand Search Form',

		/* template/content.php */
		'error_title' => '404 Not Found',
		'error_message' => 'Apologies, but no entries were found.',
		'next_post' => 'Next',
		'previous_post' => 'Previous',
		'permalink' => 'Permalink',

		/* template/comment.php */
		'next_comment' => 'Next',
		'previous_comment' => 'Previous',
		'comments_closed_pings_open' => 'Comments are closed, but trackbacks and pingbacks are open.',
		'comments_closed' => 'Comments are closed.',

		/* functions/setup.php */
		'read_more' => 'Read More',

		/* functions/custom-background.php */
		'full_size_bg' => 'Full Size Background',

	);

	/* Close sesame. */
	return $texts;
}
