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

    $associated_services = get_post_meta($post->ID, '_associated_services', true);
    if (!is_array($associated_services)) {
        $associated_services = array();
    }

    $services = get_posts(array(
        'post_type' => 'service',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));

    echo '<div class="case-service-checkboxes">';
    foreach ($services as $service) {
        echo '<label><input type="checkbox" name="associated_services[]" value="' . esc_attr($service->ID) . '"' . checked(in_array($service->ID, $associated_services), true, false) . '> ' . esc_html($service->post_title) . '</label><br>';
    }
    echo '</div>';
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

    if (isset($_POST['associated_services'])) {
        update_post_meta(
            $post_id,
            '_associated_services',
            array_map('sanitize_text_field', $_POST['associated_services'])
        );
    } else {
        delete_post_meta($post_id, '_associated_services');
    }
}
add_action('save_post_case', 'ds_save_case_service_metabox');

function add_case_service_column($columns) {
    $columns['associated_services'] = 'Сервисы';
    return $columns;
}
add_filter('manage_case_posts_columns', 'add_case_service_column');

function ds_display_case_service_column($column, $post_id) {
    if ($column === 'associated_services') {
        $associated_services = get_post_meta($post_id, '_associated_services', true);
        if (!empty($associated_services)) {
            $service_titles = array();
            foreach ($associated_services as $service_id) {
                $service = get_post($service_id);
                if ($service) {
                    $service_titles[] = esc_html($service->post_title);
                }
            }
            echo implode(', ', $service_titles);
        } else {
            echo '—';
        }
    }
}
add_action('manage_case_posts_custom_column', 'ds_display_case_service_column', 10, 2);
