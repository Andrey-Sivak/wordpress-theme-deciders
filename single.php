<?php
$ds_theme_settings = get_option('theme_settings');
$ds_current_post_type = $post->post_type;

get_header();
?>

    <main class="grid grid-cols-2 gap-x-6 items-start relative z-10">
        <div class="bg-white rounded-[20px] py-15 px-20 text-black">
            <header class="flex items-center mb-7 gap-x-3">
                <?php
                $ds_single_icon_id = get_post_meta(get_the_ID(), '_service_icon_id', true);
                $ds_single_icon_url = wp_get_attachment_image_url($ds_single_icon_id, 'thumbnail') ?? '';

                if (!$ds_single_icon_url) {
                    $ds_single_icon_url = $ds_theme_settings['default_post_title_icon'] ?? '';
                }

                if ($ds_single_icon_url) : ?>
                    <figure>
                        <img src="<?php echo $ds_single_icon_url; ?>" alt="<?php the_title() ?>">
                    </figure>
                <?php endif; ?>

                <h1 class="text-34 leading-[40px] font-bold">
                    <?php the_title(); ?>
                </h1>
            </header>

            <div class="">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="">
            <div class="layout-grid layout-2">
                <div class="grid-sizer"></div>
                <?php
                $ds_unified_content = null;
                $ds_gallery_images = null;
                $ds_is_single_post = $ds_current_post_type == 'post';
                $ds_is_single_case = $ds_current_post_type == 'case';
                $ds_is_single_service = $ds_current_post_type == 'service';

                if ($ds_is_single_post) {
                    $ds_unified_content = ds_get_unified_post_types_array(array(
                        'exclude_posts' => array('case', 'service')
                    ));
                } elseif ($ds_is_single_service) {
                    $ds_unified_content = ds_get_unified_post_types_array(array(
                        'exclude_posts' => array('post', 'service'),
                        'args' => array('service_id' => get_the_ID())
                    ));
                } elseif ($ds_is_single_case) {
                    $ds_gallery_images = get_post_meta($post->ID, '_case_gallery_images', true) ?? array();
                }
                ?>

                <?php
                if (!empty($ds_unified_content) && count($ds_unified_content)) {
                    get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content[0]]);
                } elseif ($ds_is_single_case && count($ds_gallery_images)) {
                    get_template_part('/template-parts/post-gallery-item', null, ['img_id' => $ds_gallery_images[0]]);
                }
                ?>

                <!-- Info block (2 col) -->
                <div class="masonry-item info-block info-block-1">
                    <?php
                    get_template_part('/template-parts/big-logo', null, array(
                        'url' => $ds_theme_settings['logo'],
                    ));

                    get_template_part('template-parts/service-list');
                    ?>
                </div>
                <!-- End Info block (2 col) -->

                <?php
                if (!empty($ds_unified_content) && count($ds_unified_content) > 1) {
                    $ds_unified_content_is_first_item = true;
                    foreach ($ds_unified_content as $ds_unified_content_item) {

                        if ($ds_unified_content_is_first_item) {
                            $ds_unified_content_is_first_item = false;
                            continue;
                        }

                        get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content_item]);
                    }
                } elseif ($ds_is_single_case && count($ds_gallery_images) > 1) {
                    $ds_gallery_images_is_first_item = true;
                    foreach ($ds_gallery_images as $ds_gallery_image) {

                        if ($ds_gallery_images_is_first_item) {
                            $ds_gallery_images_is_first_item = false;
                            continue;
                        }

                        get_template_part('/template-parts/post-gallery-item', null, ['img_id' => $ds_gallery_image]);
                    }
                }
                ?>
            </div>
        </div>
    </main>

<?php
get_footer();
