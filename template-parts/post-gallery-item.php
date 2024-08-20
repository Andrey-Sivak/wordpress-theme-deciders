<?php
$ds_post_gallery_item_img_id = $args['img_id'];
$ds_full_image_url = wp_get_attachment_image_url($ds_post_gallery_item_img_id, 'full');

if ($ds_post_gallery_item_img_id) :
    ?>
    <a class="masonry-item ds-post md:block flex items-center justify-center relative" data-fslightbox href="<?php echo $ds_full_image_url ?: ''?>">
        <?php
        get_template_part('/vector-images/image-loader', null, array('color' => '#63A2ED'));
        get_template_part('/template-parts/advanced-image', null, array(
            'img_id' => $ds_post_gallery_item_img_id,
            'class' => 'relative z-20 rounded-2xl'
        ));
        ?>
    </a>
<?php endif; ?>
