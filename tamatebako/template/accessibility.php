<?php
/**
 * Accessibility Template Tags
 * @since 3.0.0
**/

/**
 * Check JS Status
 * Script to modify "no-js" to "js" in body class.
 * Need to be added after the opening "<body>" tag.
 * @access public
 * @since  0.1.0
 * @return string
 */
function tamatebako_check_js_script(){
?>
<script type="text/javascript">
document.body.className = document.body.className.replace('no-js','js');
</script>
<?php
}

/**
 * Skip to Content Link
 * Need to be added before any content of the page.
 * Commonly added after the opening '<div id="container">'
 * @access public
 * @since  0.1.0
 * @return string
 */
function tamatebako_skip_to_content(){
?>
<div class="skip-link">
	<a class="screen-reader-text" href="#content"><?php echo tamatebako_string( 'skip_to_content' ); ?></a>
</div>
<?php
}
