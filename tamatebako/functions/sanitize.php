<?php
/**
 * Ready to use sanitization function.
**/

/**
 * Checkbox Sanitization Helper Function
 */
function tamatebako_sanitize_checkbox( $input ){
	if ( isset($input) && !empty($input) ){
		return true;
	}
	return false;
}

