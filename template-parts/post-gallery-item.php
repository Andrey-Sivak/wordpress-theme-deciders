<?php
$ds_post_gallery_item_img_id = $args['img_id'];

if ($ds_post_gallery_item_img_id) :
    ?>
    <div class="masonry-item ds-post md:block flex items-center justify-center relative rounded-2xl">
        <?php
        get_template_part('/vector-images/image-loader', null, array('color' => '#63A2ED'));
        get_template_part('/template-parts/advanced-image', null, array(
            'img_id' => $ds_post_gallery_item_img_id,
            'class' => 'relative z-20'
        ));
        ?>
    </div>
<?php endif; ?>
