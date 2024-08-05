<?php
$ds_post_gallery_item_img_id = $args['img_id'];

if ($ds_post_gallery_item_img_id) :
    $image_url = wp_get_attachment_image_url($ds_post_gallery_item_img_id, 'large');
    $image_alt = get_post_meta($ds_post_gallery_item_img_id, '_wp_attachment_image_alt', true);
    if ($image_url) :
        ?>

        <div class="masonry-item ds-post md:block flex items-center justify-center">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
        </div>

    <?php endif;
endif;
