<?php
$ds_theme_settings = get_option('theme_settings');
?>

<div class="info-block-inner-block relative" style="padding-top: 13px;">
    <?php
    if (is_front_page()) {
        echo '<span class="w-4 h-4 block absolute z-30 rounded-full border-2 border-white bg-[#FF4D4F] -top-1.5 -left-1.5"></span>';
    }
    ?>
    <div class="w-full items-center justify-between flex mb-2.5 opacity-60">
        <span class="text-18 leading-1.2">Online:</span>
        <span class="text-16 leading-1.2"><?php echo $ds_theme_settings['schedule']; ?></span>
    </div>
    <a href="tel:<?php echo $ds_theme_settings['phone']; ?>"
       class="mb-2.5 flex items-center gap-x-3 group">
        <?php get_template_part('/vector-images/icon', 'phone') ?>
        <span class="1.5xl:text-28 xl:text-22 lg:text-24 text-18 1.5xl.leading-[34px] leading-1.2 group-hover:underline"><?php echo $ds_theme_settings['phone']; ?></span>
    </a>

    <span class="text-18 leading-1.2 block mb-2.5 opacity-60">Other ways to get in touch:</span>
    <div class="flex items-center 1.5xl:justify-between justify-start hg:gap-x-5 1.5xl:gap-x-2 gap-x-5 gap-y-5 mb-2.5 1.5xl:flex-nowrap flex-wrap">
        <?php
        if (!empty($ds_theme_settings['social_links'])) {
            foreach ($ds_theme_settings['social_links'] as $link) {
                if (!empty($link['url']) && !empty($link['icon'])) {
                    echo '<a href="' . esc_url($link['url']) . '" target="_blank" class="hg:w-8 1.5xl:w-6 w-8"><img src="' . esc_attr($link['icon']) . '" alt="социальные сети" /><span class="hidden">Contacts | Socials</span></a>';
                }
            }
        }
        ?>
        <a href="#" class="grow ds-fill-button 1.5xl:w-auto w-full">
            <span>Перезвонить мне</span>
        </a>
    </div>
    <a href="mailto:<?php echo $ds_theme_settings['email']; ?>" class="flex items-center gap-2 mb-2.5 opacity-60 hover:opacity-100 transition-all duration-300">
        <?php get_template_part('/vector-images/icon', 'email'); ?>
        <span class="text-20 leading-1.2"><?php echo $ds_theme_settings['email']; ?></span>
    </a>

    <?php if ($ds_theme_settings['short_text']) : ?>
        <p class="text-[17px] leading-[22px] opacity-30">
            <?php echo $ds_theme_settings['short_text']; ?>
        </p>
    <?php endif; ?>
</div>
