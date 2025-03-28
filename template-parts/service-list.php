<?php
$args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
);

$ds_services = get_posts($args);

if (!empty($ds_services)) :
    ?>
    <div class="info-block-inner-block">
        <p class="text-20 leading-1.2 mb-2.5 opacity-60">Our services:</p>
        <ul class="flex lg:gap-x-6 gap-x-3 lg:gap-y-3.5 gap-y-2 flex-wrap">
            <?php foreach ($ds_services as $ds_service) :
                $ds_icon_id = get_post_meta($ds_service->ID, '_service_icon_id', true);
                $ds_icon_html = $ds_icon_id ? wp_get_attachment_image($ds_icon_id, 'thumbnail', false, array('class' => 'service-icon')) : '';
                ?>
                <li class="category-item">
                    <a href="<?php echo esc_url(get_permalink($ds_service->ID)); ?>"
                       class="flex items-center gap-x-2.5 py-1.5">
                        <?php if ($ds_icon_id) : ?>
                            <div class="">
                                <?php echo $ds_icon_html; ?>
                            </div>
                        <?php endif; ?>
                        <span class="font-bold"><?php echo $ds_service->post_title; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>