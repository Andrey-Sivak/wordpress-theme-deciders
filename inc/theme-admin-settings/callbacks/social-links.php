<?php
function theme_social_links_callback() {
    $options = get_option('theme_settings');
    $social_links = $options['social_links'] ?? array();
    ?>
    <div id="social-links-container">
        <?php
        if (!empty($social_links)) {
            foreach ($social_links as $index => $link) {
                ?>
                <div class="social-link-item">
                    <input type="hidden" name="theme_settings[social_links][<?php echo $index; ?>][icon]" value="<?php echo esc_attr($link['icon']); ?>" class="social-icon-input">
                    <img
                        src="<?php echo esc_url($link['icon']); ?>"
                        alt="Social Icon"
                        style="max-width:50px;height:auto;vertical-align:middle;margin-right:10px;"
                        class="<?php echo $link['icon'] ? '' : 'hidden' ?>"
                    >
                    <input type="button" class="button upload-social-icon" value="<?php echo $link['icon'] ? 'Изменить иконку' : 'Выбрать иконку' ?>" style="vertical-align:middle;">
                    <input type="url"
                           name="theme_settings[social_links][<?php echo $index; ?>][url]"
                           value="<?php echo esc_url($link['url']); ?>"
                           placeholder="ссылка"
                           class="regular-text">
                    <button type="button" class="button remove-social-link">Удалить</button>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button type="button" class="button" id="add-social-link">Добавить</button>

    <style>
        .social-link-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .social-link-item input {
            margin-right: 10px;
        }
    </style>
    <?php
}
