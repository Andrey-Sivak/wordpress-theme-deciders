<?php
$ds_service_data = $args['service'];
?>
<div class="masonry-item text-white pb-6.5 md:block hidden">
    <div class="info-block-inner-block">
        <div class="flex items-center gap-x-2.5 py-1.5 mb-3">
            <?php if (!empty($ds_service_data['icon_url'])) : ?>
                <div class="">
                    <img src="<?php echo $ds_service_data['icon_url']; ?>"
                         alt="<?php echo $ds_service_data['title']; ?>">
                </div>
            <?php endif; ?>
            <p class="text-white text-22 leading-1.2 font-bold">
                <?php echo $ds_service_data['title']; ?>
            </p>
        </div>
        <?php if (get_the_excerpt($ds_service_data['id'])) : ?>
            <p class="mb-3 text-[17px] leading-[27px]">
                <?php echo get_the_excerpt($ds_service_data['id']); ?>
            </p>
        <?php endif; ?>

        <a href="<?php echo $ds_service_data['permalink']; ?>"
           class="info-block-inner-block-btn">
            Подробно об услуге
        </a>
    </div>
</div>
