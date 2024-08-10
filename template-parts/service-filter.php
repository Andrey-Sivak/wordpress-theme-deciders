<?php
$ds_services = get_posts(array(
    'post_type' => 'service',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));
?>

<div class="info-block-inner-block service-filter mb-3" id="service-filter">
    <p class="text-20 leading-1.2 mb-2.5">Фильтр по услугам:</p>
    <ul
        class="service-grid flex gap-x-1.5 gap-y-3.5 flex-wrap transition-all duration-300"
        id="service-grid"
    >
        <li class="service-item" data-service-id="all">
            <button class="service-filter-btn active flex items-center gap-x-2.5 py-1.5 cursor-pointer">
                <span><?php get_template_part('/vector-images/icon', 'all-service-filter'); ?></span>
                <span class="font-bold">Все</span>
            </button>
        </li>

        <?php
        foreach ($ds_services as $ds_service) :
            $ds_icon_id = get_post_meta($ds_service->ID, '_service_icon_id', true);
            $ds_icon_html = $ds_icon_id ? wp_get_attachment_image($ds_icon_id, 'thumbnail', false, array('class' => 'service-icon')) : '';
            ?>
            <li class="service-item" data-service-id="<?php echo esc_attr($ds_service->ID); ?>">
                <button
                    class="service-filter-btn flex items-center gap-x-2.5 py-1.5 cursor-pointer"
                >
                    <?php if ($ds_icon_id) : ?>
                        <span><?php echo $ds_icon_html; ?></span>
                    <?php endif; ?>
                    <span class="font-bold"><?php echo $ds_service->post_title; ?></span>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
