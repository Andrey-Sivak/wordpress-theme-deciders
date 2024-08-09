<?php
$ds_post_gallery_item_img_id = $args['img_id'];

if ($ds_post_gallery_item_img_id) :
    ?>
    <div class="masonry-item ds-post md:block flex items-center justify-center">
        <?php get_template_part('/vector-images/image-loader', null, array('color' => '#63A2ED')); ?>

        <?php
        echo wp_get_attachment_image(
            $ds_post_gallery_item_img_id,
            'large',
            false,
            [
                'loading' => 'lazy',
                'class' => 'relative z-20'
            ]
        );
        ?>
    </div>
<?php endif; ?>
