<?php
$ds_theme_settings = get_option('theme_settings');
?>

<div class="info-block-inner-block">
    <div class="w-full items-center justify-between flex mb-2.5">
        <span class="text-20 leading-1.2">На связи:</span>
        <span class="text-20 leading-1.2"><?php echo $ds_theme_settings['schedule']; ?></span>
    </div>
    <a href="tel:<?php echo $ds_theme_settings['phone']; ?>"
       class="mb-2.5 flex items-center gap-x-3 group">
        <?php get_template_part('/vector-images/icon', 'phone') ?>
        <span class="text-28 leading-[34px] group-hover:underline"><?php echo $ds_theme_settings['phone']; ?></span>
    </a>

    <span class="text-20 leading-1.2 block mb-2.5">Другие способы:</span>
    <div class="flex items-center justify-between gap-x-5 mb-2.5">
        <?php
        if (!empty($ds_theme_settings['social_links'])) {
            foreach ($ds_theme_settings['social_links'] as $link) {
                if (!empty($link['url']) && !empty($link['icon'])) {
                    echo '<a href="' . esc_url($link['url']) . '" target="_blank" class="w-8"><img src="' . esc_attr($link['icon']) . '" /></a>';
                }
            }
        }
        ?>
        <!--TODO: fix gradient-->
        <a href="#" class="grow bg-[#5E6AE1] py-2 px-5 rounded-[8px] text-center">Перезвонить
            мне</a>
    </div>
    <a href="mailto:<?php echo $ds_theme_settings['email']; ?>" class="block mb-2.5">
        <!--TODO: fix -->
        <?php echo $ds_theme_settings['email']; ?>
    </a>

    <?php if ($ds_theme_settings['short_text']) : ?>
        <p class="text-[17px] leading-[22px]">
            <?php echo $ds_theme_settings['short_text']; ?>
        </p>
    <?php endif; ?>
</div>
