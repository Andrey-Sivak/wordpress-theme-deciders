<?php
$ds_post_data = $args['post'];
$op_additional_thumbnail = get_post_meta( $ds_post_data['id'], 'mobile_image', true );
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
                ]
            );
        }
        ?>

        <?php if ($op_additional_thumbnail) : ?>
            <img
                    src="<?php echo $op_additional_thumbnail; ?>"
                    alt="<?php echo $ds_post_data['title']; ?>"
                    class="ds-post__inner_mob-image"
            >
        <?php endif; ?>
        <span class="ds-post__inner_content">
            <span class="ds-post__inner_title"><?php echo $ds_post_data['title']; ?></span>
            <span class="ds-post__inner_excerpt"><?php echo $ds_post_data['excerpt']; ?></span>
        </span>
    </span>
</a>
