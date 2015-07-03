<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body itemtype="http://schema.org/WebPage" itemscope="itemscope" <?php body_class(); ?>>
<?php echo tamatebako_check_js_script(); ?>