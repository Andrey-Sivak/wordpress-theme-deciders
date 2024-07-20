<?php
$ds_theme_settings = get_option('theme_settings');
$ds_unified_content = ds_get_unified_post_types_array();

get_header();
?>

    <main class="relative z-10">
        <div class="layout-grid layout-4">
            <div class="grid-sizer"></div>

            <?php if (!empty($ds_unified_content)) : ?>

                <!-- First item (post) -->
                <?php get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content[0]]); ?>

                <!-- First info block (2 col) -->
                <div class="masonry-item info-block info-block-1">
                    <?php get_template_part('/template-parts/big-logo', null, array(
                            'url' => $ds_theme_settings['logo'],
                    )) ?>
                    <div class="info-block-inner-block">
                        <p class="info-block-inner-block-heading">Об агентстве</p>
                        <p class="info-block-inner-block-text">
                            <?php echo wp_kses_post($ds_theme_settings['about_text']); ?>
                        </p>
                        <a href="#" class="info-block-inner-block-btn">Подробно об агенстве</a>
                    </div>
                    <?php get_template_part('template-parts/service-list'); ?>
                </div>
                <!-- End first info block (2 col) -->

                <!-- Second info block (3 col) -->
                <div class="masonry-item info-block info-block-2">
                    <p class="text-50 mb-13.5 leading-[59px]">
                        <?php echo get_bloginfo('description'); ?>
                    </p>
                    <?php get_template_part('/template-parts/contacts-block'); ?>
                </div>
                <!-- End second info block (3 col) -->

                <?php
                $ds_unified_content_is_first_item = true;
                foreach ($ds_unified_content as $ds_unified_content_item) :

                    if ($ds_unified_content_is_first_item) {
                        $ds_unified_content_is_first_item = false;
                        continue;
                    }

                    if ($ds_unified_content_item['type'] == 'service') {
                        get_template_part('/template-parts/service-card', null, ['service' => $ds_unified_content_item]);
                        continue;
                    }

                    get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content_item]);
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </main>
    <style>
        /* Styles for info blocks */
        .info-block {
            padding-top: 90px;
        }

        .info-block-inner-block:not(:last-of-type) {
            margin-bottom: 12px;
        }

        .info-block-inner-block-heading {
            margin-bottom: 18px;
            font-weight: bold;
            font-size: 22px;
            line-height: 28px;
            /*letter-spacing: 0.4px;*/
        }

        .info-block-inner-block-text {
            margin-bottom: 7px;
            font-size: 17px;
            line-height: 22px;
        }

        .info-block-inner-block-btn {
            display: block;
            width: 100%;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, .25);
            padding: 8px 0;
            font-size: 15px;
            line-height: 20px;
        }

        .info-block-inner-block-title {
            margin-bottom: 10px;
            font-size: 20px;
            line-height: 25px;
        }

        .info-block-inner-block-categories {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            column-gap: 22px;
            row-gap: 8px;
        }

        .info-block-inner-block-category {
            display: flex;
            align-items: center;
            padding: 6px 0;
            cursor: pointer;
            column-gap: 8px;
        }
    </style>
<?php
get_footer();
