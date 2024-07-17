<?php
function ds_theme_about_text_callback() {
    $options = get_option('theme_settings');
    ?>
    <textarea name="theme_settings[about_text]" rows="5" cols="50"><?php echo esc_textarea($options['about_text'] ?? ''); ?></textarea>
    <?php
}