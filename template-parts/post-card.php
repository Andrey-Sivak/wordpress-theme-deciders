<?php
$ds_post_data = $args['post'];
$ds_additional_thumbnail = get_post_meta( $ds_post_data['id'], 'mobile_image', true );
$ds_additional_thumbnail_cover = get_post_meta( $ds_post_data['id'], 'cover', true );
$ds_additional_thumbnail_id = attachment_url_to_postid($ds_additional_thumbnail);

$ds_css_class = 'masonry-item group text-white ds-post md:pb-6.5 pb-0';

if ($ds_additional_thumbnail) {
    $ds_css_class .= ' ds-post__has-mob-img';
}

if ($ds_additional_thumbnail_cover) {
    $ds_css_class .= ' ds-post__mob-cover';
}
?>

<a href="<?php echo $ds_post_data['permalink']; ?>" class="<?php echo $ds_css_class; ?>">
    <span class="ds-post__inner">
        <?php get_template_part('/vector-images/image-loader', null, array('color' => $ds_post_data['type'] == 'post' ? '#63A2ED' : '#FC8AEA')); ?>


        <?php
        if (has_post_thumbnail($ds_post_data['id'])) {
            get_template_part('/template-parts/advanced-image', null, array(
                'img_id' => get_post_thumbnail_id($ds_post_data['id']),
                'class' => 'ds-post__inner_thumbnail',
                'alt' => 'Image for' . $ds_post_data['title'],
            ));
        }
        ?>

        <?php
        if ($ds_additional_thumbnail) {
            get_template_part('/template-parts/advanced-image', null, array(
                'img_id' => $ds_additional_thumbnail_id,
                'class' => 'ds-post__inner_mob-image',
                'alt' => 'Image for' . $ds_post_data['title'],
            ));
        }
        ?>
        <span class="ds-post__inner_content">
            <span class="ds-post__inner_title"><?php echo $ds_post_data['title']; ?></span>
            <span class="ds-post__inner_excerpt"><?php echo $ds_post_data['excerpt']; ?></span>
        </span>
    </span>
</a>
