<?php
function ds_add_case_gallery_meta_box()
{
    add_meta_box(
        'case_gallery_meta_box',
        'Gallery',
        'ds_render_case_gallery_meta_box',
        'case',
        'normal',
        'high'
    );
}

add_action('add_meta_boxes', 'ds_add_case_gallery_meta_box');

function ds_render_case_gallery_meta_box($post)
{
    wp_nonce_field('case_gallery_meta_box', 'case_gallery_meta_box_nonce');

    $gallery_images = get_post_meta($post->ID, '_case_gallery_images', true);

    ?>
    <div class="case-gallery-wrapper">
        <div id="case-gallery-container">
            <?php
            if (!empty($gallery_images)) {
                foreach ($gallery_images as $image_id) {
                    $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                    echo '<div class="gallery-image-wrapper" data-id="' . esc_attr($image_id) . '">';
                    echo '<img src="' . esc_url($image_url) . '" />';
                    echo '<button type="button" class="remove-image">Remove</button>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <input type="hidden" name="case_gallery_images" id="case_gallery_images"
               value="<?php echo esc_attr(implode(',', (array)$gallery_images)); ?>"/>
        <button type="button" id="add_gallery_images" class="button">Select Image</button>
    </div>
    <?php
}

function ds_save_case_gallery_meta_box($post_id) {
    if (!isset($_POST['case_gallery_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['case_gallery_meta_box_nonce'], 'case_gallery_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['case_gallery_images'])) {
        $gallery_images = explode(',', sanitize_text_field($_POST['case_gallery_images']));
        $gallery_images = array_filter($gallery_images);
        update_post_meta($post_id, '_case_gallery_images', $gallery_images);
    } else {
        delete_post_meta($post_id, '_case_gallery_images');
    }
}
add_action('save_post', 'ds_save_case_gallery_meta_box');

// Enqueue media uploader script
function ds_case_gallery_enqueue_scripts(): void
{
    $screen = get_current_screen();
    if ($screen->base === 'post' && $screen->post_type === 'case') {
        wp_enqueue_media();
        wp_enqueue_script('ds-case-gallery-script', get_template_directory_uri() . '/inc/case-gallery-admin/index.js', array('jquery'), '1.0', true);
        wp_enqueue_style('ds-case-gallery-style', get_template_directory_uri() . '/inc/case-gallery-admin/index.css', array(), '1.0');
    }
}

add_action('admin_enqueue_scripts', 'ds_case_gallery_enqueue_scripts');