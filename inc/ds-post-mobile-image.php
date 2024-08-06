<?php
function ds_register_meta_mobile_image(): void
{
    $ds_post_types = ['post', 'case'];

    foreach ($ds_post_types as $post_type) {
        register_post_meta(
            $post_type,
            'mobile_image',
            [
                'show_in_rest' => true,
                'single'       => true,
                'type'         => 'string',
            ]
        );
    }
}

function ds_add_mobile_image_metabox(): void
{
    $ds_post_types = ['post', 'case'];

    foreach ($ds_post_types as $post_type) {
        add_meta_box(
            'mobile_image_metabox',
            'Изображение для мобильных устройств',
            'ds_render_mobile_image_metabox',
            $post_type,
            'side',
            'high'
        );
    }
}

function ds_render_mobile_image_metabox( $post ): void
{
    $mobile_image = get_post_meta( $post->ID, 'mobile_image', true );
    ?>
    <div class="custom-media-uploader">
        <img src="<?php echo esc_url( $mobile_image ); ?>"
             alt=""
             style="max-width:100%;width:100%;">
        <input type="hidden" id="mobile_image" name="mobile_image" value="<?php echo esc_attr( $mobile_image ); ?>" style="width: 100%;">
        <div class="" style="display: flex;align-items: center;column-gap: 16px">
            <button class="button button-secondary" id="upload_mobile_image">Выбрать</button>
            <button class="button" id="remove_mobile_image" style="display: none">Удалить</button>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($){
            let customUploader;
            const uploadButton = document.querySelector('button#upload_mobile_image');
            const removeButton = document.querySelector('button#remove_mobile_image');

            $('#upload_mobile_image').on('click', function(e){
                e.preventDefault();

                if (customUploader) {
                    customUploader.open();
                    return;
                }

                customUploader = wp.media({
                    title: 'Выбрать дополнительное изображение',
                    button: {
                        text: 'Выбрать'
                    },
                    multiple: false
                });

                customUploader.on('select', function() {
                    const attachment = customUploader.state().get('selection').first().toJSON();
                    $('#mobile_image').val(attachment.url);
                    $('.custom-media-uploader img').attr('src', attachment.url);
                    uploadButton.innerHTML = 'Изменить';
                    removeButton.style.display = 'block';
                });

                customUploader.open();
            });

            $('#remove_mobile_image').on('click', function() {
                $('#mobile_image').val('');
                $('.custom-media-uploader img').attr('src', '');
                uploadButton.innerHTML = 'Выбрать';
                removeButton.style.display = 'none';
            });
        });
    </script>
    <?php
}

function ds_save_mobile_image( $post_id ): void
{
    if ( isset( $_POST['mobile_image'] ) ) {
        update_post_meta( $post_id, 'mobile_image', esc_url_raw( $_POST['mobile_image'] ) );
    }
}

function ds_mobile_image_metabox_scripts( $hook ): void
{
    global $post_type;

    if ( ( 'post.php' !== $hook && 'post-new.php' !== $hook ) ||
        ( 'post' !== $post_type && 'case' !== $post_type ) ) {
        return;
    }

    wp_enqueue_media();
}

add_action( 'init', 'ds_register_meta_mobile_image' );
add_action( 'add_meta_boxes', 'ds_add_mobile_image_metabox' );
add_action( 'save_post', 'ds_save_mobile_image' );
add_action( 'admin_enqueue_scripts', 'ds_mobile_image_metabox_scripts' );
