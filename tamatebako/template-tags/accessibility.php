<?php
/**
 * Accessibility Template Tags
**/

/**
 * Check JS Status
 * Script to modify "no-js" to "js" in body class.
 * Need to be added after the opening "<body>" tag.
 *
 * @since 0.1.0
 */
function tamatebako_check_js_script(){
	$script  = '<script type="text/javascript">';
	$script .= "document.body.className = document.body.className.replace('no-js','js');";
	$script .= '</script>';
	echo apply_filters( 'tamatebako_check_js_script', $script );
}



/**
 * Skip to Content Link (accessibility)
 * Better to be added before any content of the page.
 * Commonly added after the opening '<div id="container">'
 *
 * @since 0.1.0
 */
function tamatebako_skip_to_content(){
?>
<div class="skip-link">
	<a class="screen-reader-text" href="#content"><?php echo tamatebako_string( 'skip-to-content' ); ?></a>
</div>
<?php
}





