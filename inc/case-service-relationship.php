<?php
function add_case_service_metabox() {
    add_meta_box(
        'case_service_metabox',
        'Сервис',
        'ds_render_case_service_metabox',
        'case',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_case_service_metabox');

function ds_render_case_service_metabox($post) {
    wp_nonce_field('case_service_metabox', 'case_service_metabox_nonce');

    $associated_service = get_post_meta($post->ID, '_associated_service', true);

    $services = get_posts(array(
        'post_type' => 'service',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));

    echo '<select name="associated_service" id="associated_service">';
    echo '<option value="">Выберите сервис</option>';

    foreach ($services as $service) {
        echo sprintf(
            '<option value="%s" %s>%s</option>',
            esc_attr($service->ID),
            selected($associated_service, $service->ID, false),
            esc_html($service->post_title)
        );
    }

    echo '</select>';
}

function ds_save_case_service_metabox($post_id) {
    if (!isset($_POST['case_service_metabox_nonce']) ||
        !wp_verify_nonce($_POST['case_service_metabox_nonce'], 'case_service_metabox')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['associated_service'])) {
        update_post_meta(
            $post_id,
            '_associated_service',
            sanitize_text_field($_POST['associated_service'])
        );
    } else {
        delete_post_meta($post_id, '_associated_service');
    }
}
add_action('save_post_case', 'ds_save_case_service_metabox');

function add_case_service_column($columns) {
    $columns['associated_service'] = 'Сервис';
    return $columns;
}
add_filter('manage_case_posts_columns', 'add_case_service_column');

function ds_display_case_service_column($column, $post_id) {
    if ($column === 'associated_service') {
        $service_id = get_post_meta($post_id, '_associated_service', true);
        if ($service_id) {
            $service = get_post($service_id);
            if ($service) {
                echo esc_html($service->post_title);
            }
        } else {
            echo '—';
        }
    }
}
add_action('manage_case_posts_custom_column', 'ds_display_case_service_column', 10, 2);