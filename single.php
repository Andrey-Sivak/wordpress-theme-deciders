<?php
$ds_theme_settings = get_option('theme_settings');
$ds_current_post_type = $post->post_type;

get_header();
?>

    <main class="grid grid-cols-2 gap-x-6 pt-22 items-start">
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

                if ($ds_current_post_type == 'post') {
                    $ds_unified_content = ds_get_unified_post_types_array(array(
                        'exclude_posts' => array('case', 'service')
                    ));
                } elseif ($ds_current_post_type == 'case') {
//                    $ds_unified_content = null;
                } elseif ($ds_current_post_type == 'service') {
                    $ds_unified_content = ds_get_unified_post_types_array(array(
                        'exclude_posts' => array('post', 'service')
                    ));
                }
                ?>

                <?php
                if (!empty($ds_unified_content) && count($ds_unified_content) > 0) {
                    get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content[0]]);
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
                }
                ?>
            </div>
        </div>
	</main>

<?php
get_footer();
