<?php
function ds_add_service_icon_metabox() {
    add_meta_box(
        'service_icon_metabox',
        'Иконка',
        'ds_render_service_icon_metabox',
        'service',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'ds_add_service_icon_metabox');

function ds_render_service_icon_metabox($post) {
    wp_nonce_field('service_icon_metabox', 'service_icon_metabox_nonce');

    $icon_id = get_post_meta($post->ID, '_service_icon_id', true);
    $icon_url = $icon_id ? wp_get_attachment_image_url($icon_id, 'thumbnail') : '';

    ?>
    <div class="service-icon-wrapper">
        <div class="service-icon-preview" style="margin-bottom: 12px;">
            <?php if ($icon_url) : ?>
                <img src="<?php echo esc_url($icon_url); ?>" style="max-width: 100%; height: auto;" />
            <?php endif; ?>
        </div>
        <input type="hidden" name="service_icon_id" id="service_icon_id" value="<?php echo esc_attr($icon_id); ?>" />
        <button type="button" class="upload_icon_button button"><?php echo $icon_id ? 'Изменить' : 'Выбрать'; ?></button>
        <?php if ($icon_id) : ?>
            <button type="button" class="remove_icon_button button"><?php echo 'Удалить'; ?></button>
        <?php endif; ?>
    </div>
    <script>
        jQuery(document).ready(function($){
            $('.service-icon-wrapper').get(0).parentElement.parentElement.style.backgroundColor = 'rgba(0,0,0,.2)';

            var frame;
            $('.upload_icon_button').click(function(e) {
                e.preventDefault();
                if (frame) {
                    frame.open();
                    return;
                }
                frame = wp.media({
                    title: 'Выберите иконку для сервиса',
                    button: {
                        text: 'Использовать это изображение'
                    },
                    multiple: false
                });
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('#service_icon_id').val(attachment.id);
                    $('.service-icon-preview').html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto;" />');
                    $('.upload_icon_button').text('Изменить');
                    $('.remove_icon_button').show();
                });
                frame.open();
            });
            $('.remove_icon_button').click(function(e) {
                e.preventDefault();
                $('#service_icon_id').val('');
                $('.service-icon-preview').html('');
                $('.upload_icon_button').text('Выбрать');
                $(this).hide();
            });
        });
    </script>
    <?php
}

function ds_save_service_icon_metabox($post_id) {
    if (!isset($_POST['service_icon_metabox_nonce']) ||
        !wp_verify_nonce($_POST['service_icon_metabox_nonce'], 'service_icon_metabox')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['service_icon_id'])) {
        update_post_meta(
            $post_id,
            '_service_icon_id',
            sanitize_text_field($_POST['service_icon_id'])
        );
    } else {
        delete_post_meta($post_id, '_service_icon_id');
    }
}
add_action('save_post_service', 'ds_save_service_icon_metabox');

function ds_add_service_icon_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns[$key] = $value;
            $new_columns['service_icon'] = 'Иконка';
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_service_posts_columns', 'ds_add_service_icon_column');

function ds_display_service_icon_column($column, $post_id) {
    if ($column === 'service_icon') {
        $icon_id = get_post_meta($post_id, '_service_icon_id', true);
        if ($icon_id) {
            echo wp_get_attachment_image($icon_id, array(50, 50));
        } else {
            echo '—';
        }
    }
}
add_action('manage_service_posts_custom_column', 'ds_display_service_icon_column', 10, 2);
