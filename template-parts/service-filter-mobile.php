<?php
$ds_services = get_posts(array(
    'post_type' => 'service',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));
?>

<div class="ds-mobile-filters fixed md:hidden block top-5 -translate-y-[150px] left-5 bg-deciders-dark py-2 rounded-[16px] transition-all duration-500 z-40 border border-white/20">
    <div class="ds-mobile-filters__button flex items-center gap-3 px-5">
        <span class="ds-mobile-filters__button_icon"><?php get_template_part('/vector-images/icon', 'all-service-filter'); ?></span>
        <div class="ds-mobile-filters__button_text font-semibold">Все</div>
    </div>
    <ul class="ds-mobile-filters__list mt-2 gap-0.5 hidden">
        <li
                class="py-2 hidden items-center gap-x-2.5 cursor-pointer px-5 service-item-mob"
                data-service-id="all"
        >
            <span class="service-item-mob__icon"><?php get_template_part('/vector-images/icon', 'all-service-filter'); ?></span>
            <span class="service-item-mob__text font-semibold">Все</span>
        </li>
        <?php
        foreach ($ds_services as $ds_service) :
            $ds_icon_id = get_post_meta($ds_service->ID, '_service_icon_id', true);
            $ds_icon_html = $ds_icon_id ? wp_get_attachment_image($ds_icon_id, 'thumbnail', false, array('class' => 'service-icon')) : '';
            ?>
            <li
                    class="py-2 flex items-center gap-x-2.5 cursor-pointer px-5 service-item-mob"
                    data-service-id="<?php echo esc_attr($ds_service->ID); ?>"
            >
                <?php if ($ds_icon_id) : ?>
                    <span class="service-item-mob__icon"><?php echo $ds_icon_html; ?></span>
                <?php endif; ?>
                <span class="service-item-mob__text font-semibold"><?php echo $ds_service->post_title; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="ds-mobile-filters__overlay fixed z-30 inset-0 hidden"></div>