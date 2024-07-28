<?php
$ds_big_logo_url = $args['url'];
?>

<figure class="relative flex mx-auto mt-0 mb-9.5 <?php echo is_front_page() ? 'ml-13.5' : 'ml-3.5'; ?>">
    <a href="<?php echo get_home_url(); ?>" class="absolute inset-0 z-20"></a>
    <img
            src="<?php echo $ds_big_logo_url; ?>"
            alt="<?php echo get_bloginfo('title'); ?>"
            style="max-width: 252px;"
            class="relative z-10"
    >
</figure>
