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

$ds_theme_settings = get_option('theme_settings');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-deciders-dark lg:px-7.5 px-5 font-sf-pro text-white relative min-h-screen' ); ?>>
<?php wp_body_open(); ?>
<header class="site-header bg-[#e7e7e7] fixed z-20 top-0 left-1/2 -translate-x-1/2 rounded-b-[40px] pt-2.5 pb-2 px-13.5 flex items-center gap-x-9.5">
    <?php
    $ds_home_icon_url = $ds_theme_settings['home_menu_icon'] ?? '';
    ?>
    <a href="<?php echo get_home_url(); ?>" class="h-5">
        <img src="<?php echo $ds_home_icon_url; ?>" alt="<?php the_title() ?>" class="w-auto max-h-full">
    </a>
    <a href="<?php echo get_home_url() . '/case/'; ?>" class="h-5">
        <?php get_template_part('/vector-images/icon', 'cases-menu'); ?>
    </a>
</header>

<div class="absolute z-0 inset-0 overflow-hidden">
    <?php
    if (is_front_page() || is_archive()) {
        get_template_part(
            '/vector-images/bg-decor',
            'primary-top',
            array(
                'class' => 'block absolute z-0 left-1/2 -translate-x-1/2 w-full top-0'
            )
        );

        get_template_part(
            '/vector-images/bg-decor',
            'primary-center',
            array(
                'class' => 'block absolute z-0 left-1/2 -translate-x-1/2 w-full top-[80vw] -rotate-[169deg]'
            )
        );
    } else {
        get_template_part(
            '/vector-images/bg-decor',
            'primary-top',
            array(
                'class' => 'block absolute z-0 left-1/2 -translate-x-1/2 w-full top-0 -rotate-[169deg]'
            )
        );
    }
    ?>
</div>