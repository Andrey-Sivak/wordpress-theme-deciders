<?php
$ds_theme_settings = get_option('theme_settings');
$ds_unified_content = ds_get_unified_post_types_array();

get_header();
?>

    <main class="relative z-10">

        <div class="masonry-item info-block info-block-1 md:hidden block">
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
        <div class="masonry-item info-block info-block-2 md:hidden block">
            <p class="2xl:text-50 1.5xl:text-40 text-32 mb-13.5 2xl:leading-[59px] leading-1.2">
                <?php echo get_bloginfo('description'); ?>
            </p>
            <?php get_template_part('/template-parts/contacts-block'); ?>
        </div>

        <div class="layout-grid layout-4" id="well" style="transition: .7s cubic-bezier(0.5, 0, 0.5, 1);">
            <div class="grid-sizer"></div>

            <?php if (!empty($ds_unified_content)) : ?>

                <!-- First item (post) -->
                <?php get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content[0]]); ?>

                <!-- First info block (2 col) -->
                <div class="masonry-item info-block info-block-1 md:block hidden">
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
                <div class="masonry-item info-block info-block-2 md:block hidden">
                    <p class="2xl:text-50 1.5xl:text-40 text-32 mb-13.5 2xl:leading-[59px] leading-1.2">
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
<?php
get_footer();
