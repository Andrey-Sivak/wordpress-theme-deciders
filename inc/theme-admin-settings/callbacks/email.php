<?php
function theme_email_callback() {
    $options = get_option('theme_settings');
    ?>
    <input type="email" name="theme_settings[email]" value="<?php echo esc_attr($options['email'] ?? ''); ?>" class="regular-text">
    <?php
}