<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Deciders
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-deciders-dark px-7.5 font-sf-pro text-white pt-22 relative' ); ?>>
<?php wp_body_open(); ?>
<header class="site-header bg-[#e7e7e7] fixed z-20 top-0 left-1/2 -translate-x-1/2 rounded-b-[40px] pt-2.5 pb-2 px-13.5"></header>
