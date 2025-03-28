<?php
function ds_theme_logo_callback()
{
    $options = get_option('theme_settings');
    ?>
    <input type="hidden" name="theme_settings[logo]" value="<?php echo esc_attr($options['logo'] ?? ''); ?>"
           class="regular-text">
    <input type="button" class="button button-secondary"
           value="<?php echo $options['logo'] ? 'Change Logo' : 'Select Logo'; ?>" id="upload_logo_button">
    <br>
    <img src="<?php echo esc_attr($options['logo'] ?? ''); ?>" style="max-width:200px;height:auto;margin-top:10px;">
    <?php
}