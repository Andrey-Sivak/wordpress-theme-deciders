<?php
function theme_short_text_callback() {
    $options = get_option('theme_settings');
    ?>
    <textarea name="theme_settings[short_text]" rows="3" cols="50"><?php echo esc_textarea($options['short_text'] ?? ''); ?></textarea>
    <?php
}