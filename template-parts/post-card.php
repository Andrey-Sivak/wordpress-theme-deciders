<?php
$ds_post_data = $args['post'];
?>

<a href="<?php echo $ds_post_data['permalink']; ?>" class="masonry-item group text-white">
    <?php
    if (has_post_thumbnail($ds_post_data['id'])) {
        echo get_the_post_thumbnail(
            $ds_post_data['id'],
            'large',
            [
                'class' => 'relative z-20'
            ]
        );
    }
    ?>
</a>
