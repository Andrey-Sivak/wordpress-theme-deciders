<?php
$ds_theme_settings = get_option('theme_settings');
$ds_unified_content = ds_get_unified_post_types_array(array(
    'exclude_posts' => array('post', 'service')
));

get_header();
?>

	<main class="grid grid-cols-[1fr_3fr] gap-x-6 items-start relative z-10">
        <div class="">
            <?php
            get_template_part('/template-parts/big-logo', null, array(
                'url' => $ds_theme_settings['logo'],
            ));

            get_template_part('template-parts/service-list');
            ?>
        </div>

        <div>
            <div class="layout-grid layout-3">
                <div class="grid-sizer"></div>
                <?php
                foreach ($ds_unified_content as $ds_unified_content_item) {
                    get_template_part('/template-parts/post-card', null, ['post' => $ds_unified_content_item]);
                }
                ?>
            </div>
        </div>
	</main>

<?php
get_footer();
