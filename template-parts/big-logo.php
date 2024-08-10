<?php
$ds_big_logo_url = $args['url'];
?>

<figure class="relative flex mx-auto mt-0 mb-9.5 <?php echo is_front_page() ? '1.5xl:ml-13.5 ml-2' : 'ml-3.5'; ?>">
    <a href="<?php echo get_home_url(); ?>" class="absolute inset-0 z-20" title="<?php the_title() ?>">
        <span class="hidden"><?php the_title() ?></span>
    </a>
    <img
            src="<?php echo $ds_big_logo_url; ?>"
            alt="<?php echo get_bloginfo('title'); ?>"
            class="relative z-10 1.5xl:max-w-[252px] max-w-full"
    >
</figure>
