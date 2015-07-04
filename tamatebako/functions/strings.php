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

	$texts = array();

	/* layouts */
	$texts['default'] = 'Default';
	$texts['layout'] = 'Layout';
	$texts['global_layout'] = 'Global Layout';

	/* template/accessibility.php */
	$texts['skip_to_content'] = 'Skip to content';

	/* template/menu.php */
	$texts['next_posts'] = 'Next';
	$texts['previous_posts'] = 'Previous';

	/* template/menu.php */
	$texts['menu_search_placeholder'] = 'Search&hellip;';
	$texts['menu_search_button'] = 'Search';
	$texts['menu_search_form_toggle'] = 'Expand Search Form';

	/* template/content.php */
	$texts['error_title'] = '404 Not Found';
	$texts['error_message'] = 'Apologies, but no entries were found.';
	$texts['next_post'] = 'Next';
	$texts['previous_post'] = 'Previous';
	$texts['permalink'] = 'Permalink';

	/* template/comment.php */
	$texts['next_comment'] = 'Next';
	$texts['previous_comment'] = 'Previous';
	$texts['comments_closed_pings_open'] = 'Comments are closed, but trackbacks and pingbacks are open.';
	$texts['comments_closed'] = 'Comments are closed.';

	/* functions/setup.php */
	$texts['read_more'] = 'Read More';

	/* Filter */
	$texts = apply_filters( 'tamatebako_strings', $texts );

	/* Output */
	if ( isset( $texts[$context] ) ){
		return $texts[$context];
	}
	return $context;
}
