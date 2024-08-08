<?php
$ds_theme_settings = get_option('theme_settings');

$ds_cases = ds_get_unified_post_types_array(array(
    'exclude_posts' => array('service', 'post')
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
                if (!empty($ds_cases)) {
                    foreach ($ds_cases as $ds_case) {
                        get_template_part('/template-parts/post-card', null, ['post' => $ds_case]);
                    }
                }
                ?>
            </div>
        </div>
    </main>

<?php
get_footer();
