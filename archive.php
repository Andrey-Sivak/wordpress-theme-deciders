<?php
$ds_theme_settings = get_option('theme_settings');

$ds_cases = get_posts(array(
    'post_type' => 'case',
    'post_status' => 'publish',
    'posts_per_page' => -1,
));

get_header();
?>

    <main class="grid xl:grid-cols-[1fr_3fr] lg:grid-cols-[1fr_2fr] md:grid-cols-[1.5fr_2fr] gap-x-6 gap-y-6 relative z-10">
        <div class="relative">
            <?php
            get_template_part('/template-parts/big-logo', null, array(
                'url' => $ds_theme_settings['logo'],
            ));
            ?>
            <div class="sticky top-5 left-0 service-filter-container">
                <?php
                get_template_part('/template-parts/service-filter');
                get_template_part('/template-parts/contacts-block');
                ?>
            </div>
        </div>

        <div>
            <div class="layout-grid layout-3" id="cases-list">
                <div class="grid-sizer"></div>
                <?php
                foreach ($ds_cases as $ds_case) : ?>
                    <a href="<?php echo get_permalink($ds_case->ID); ?>" class="masonry-item group text-white ds-post md:pb-6.5 pb-0">
                        <?php
                        if (has_post_thumbnail($ds_case->ID)) {
                            echo get_the_post_thumbnail(
                                $ds_case->ID,
                                'large',
                                [
                                    'class' => 'relative z-20'
                                ]
                            );
                        }
                        ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

<?php
get_footer();
