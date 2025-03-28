<?php
function ds_theme_default_post_title_icon()
{
    $options = get_option('theme_settings');
    ?>
    <input type="hidden" name="theme_settings[default_post_title_icon]"
           value="<?php echo esc_attr($options['default_post_title_icon'] ?? ''); ?>" class="regular-text">
    <input type="button" class="button button-secondary"
           value="<?php echo $options['default_post_title_icon'] ? 'Change Icon' : 'Select Icon'; ?>"
           id="upload_default_post_title_icon_button">
    <br>
    <img src="<?php echo esc_attr($options['default_post_title_icon'] ?? ''); ?>"
         style="max-width:200px;height:auto;margin-top:10px;">
    <?php
}