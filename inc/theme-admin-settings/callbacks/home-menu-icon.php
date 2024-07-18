<?php
function ds_theme_home_menu_icon() {
    $options = get_option('theme_settings');
    ?>
    <input type="hidden" name="theme_settings[home_menu_icon]" value="<?php echo esc_attr($options['home_menu_icon'] ?? ''); ?>" class="regular-text">
    <input type="button" class="button button-secondary" value="<?php echo $options['home_menu_icon'] ? 'Изменить иконку' : 'Выбрать иконку'; ?>" id="upload_home_menu_icon_button">
    <br>
    <img src="<?php echo esc_attr($options['home_menu_icon'] ?? ''); ?>" style="max-width:200px;height:auto;margin-top:10px;">
    <?php
}