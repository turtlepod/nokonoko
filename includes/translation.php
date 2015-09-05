<?php
/**
 * Make Framework Translatable
**/

/* Load Text Domain */
load_theme_textdomain( 'nokonoko', get_template_directory() . '/assets/languages' );

/* Make all string in the framework translatable. */
$texts = array(

	/* functions/template/accessibility.php */
	'skip_to_content'             => _x( 'Skip to content', 'accessibility', 'nokonoko' ),

	/* functions/template/general.php */
	'next_posts'                  => _x( 'Next', 'pagination', 'nokonoko' ),
	'previous_posts'              => _x( 'Previous', 'pagination', 'nokonoko' ),

	/* functions/template/menu.php */
	'menu_search_placeholder'     => _x( 'Search&hellip;', 'nav menu', 'nokonoko' ),
	'menu_search_button'          => _x( 'Search', 'nav menu', 'nokonoko' ),
	'menu_search_form_toggle'     => _x( 'Expand Search Form', 'nav menu', 'nokonoko' ),
	'menu_default_home'           => _x( 'Home', 'nav menu', 'nokonoko' ),

	/* functions/template/entry.php */
	'error_title'                 => _x( '404 Not Found', 'entry', 'nokonoko' ),
	'error_message'               => _x( 'Apologies, but no entries were found.', 'entry', 'nokonoko' ),
	'next_post'                   => _x( 'Next', 'entry', 'nokonoko' ),
	'previous_post'               => _x( 'Previous', 'entry', 'nokonoko' ),

	/* functions/template/comment.php */
	'next_comment'                => _x( 'Next', 'comment', 'nokonoko' ),
	'previous_comment'            => _x( 'Previous', 'comment', 'nokonoko' ),
	'comments_closed_pings_open'  => _x( 'Comments are closed, but trackbacks and pingbacks are open.', 'comment', 'nokonoko' ),
	'comments_closed'             => _x( 'Comments are closed.', 'comment', 'nokonoko' ),

	/* functions/setup.php */
	'untitled'                    => _x( '(Untitled)', 'entry', 'nokonoko' ),
	'read_more'                   => _x( 'Read More', 'entry', 'nokonoko' ),
	'search_title_prefix'         => _x( 'Search:', 'archive title', 'nokonoko' ),
	'comment_moderation_message'  => _x( 'Your comment is awaiting moderation.', 'comment', 'nokonoko' ),

);

/* Add text to tamatebako */
tamatebako_load_strings( $texts );