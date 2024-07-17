<?php
function theme_phone_callback() {
    $options = get_option('theme_settings');
    ?>
    <input type="tel" name="theme_settings[phone]" value="<?php echo esc_attr($options['phone'] ?? ''); ?>" class="regular-text">
    <?php
}