<?php
$ds_post_data = $args['post'];
$op_additional_thumbnail = get_post_meta( $ds_post_data['id'], 'mobile_image', true );
$op_additional_thumbnail_id = attachment_url_to_postid($op_additional_thumbnail);
?>

<a
        href="<?php echo $ds_post_data['permalink']; ?>"
        class="masonry-item group text-white ds-post md:pb-6.5 pb-0 <?php echo $op_additional_thumbnail ? 'ds-post__has-mob-img' : ''; ?>"
>
    <span class="ds-post__inner">
        <?php
        if (has_post_thumbnail($ds_post_data['id'])) {
            echo get_the_post_thumbnail(
                $ds_post_data['id'],
                'large',
                [
                    'class' => 'ds-post__inner_thumbnail',
                    'alt' => $ds_post_data['title'],
                    'loading' => 'lazy',
                ]
            );
        }
        ?>

        <?php
        if ($op_additional_thumbnail) {
            echo wp_get_attachment_image(
                $op_additional_thumbnail_id,
                'large',
                false,
                [
                    'class' => 'ds-post__inner_mob-image',
                    'alt' => $ds_post_data['title'],
                    'loading' => 'lazy',
                ]
            );
        }
        ?>
        <span class="ds-post__inner_content">
            <span class="ds-post__inner_title"><?php echo $ds_post_data['title']; ?></span>
            <span class="ds-post__inner_excerpt"><?php echo $ds_post_data['excerpt']; ?></span>
        </span>
    </span>
</a>
