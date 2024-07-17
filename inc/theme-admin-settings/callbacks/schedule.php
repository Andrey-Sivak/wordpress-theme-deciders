<?php
function theme_schedule_callback() {
    $options = get_option('theme_settings');
    ?>
    <textarea name="theme_settings[schedule]" rows="3" cols="50"><?php echo esc_textarea($options['schedule'] ?? ''); ?></textarea>
    <?php
}