<?php
$img_id = $args['img_id'];
$img_class = $args['class'];
$img_alt = $args['alt'];

if ($img_id) :
    $image_sizes = ['medium', 'large', 'full'];
    $original_srcset = [];
    $sizes = [];

    foreach ($image_sizes as $size) {
        $original_image = wp_get_attachment_image_src($img_id, $size);

        if ($original_image) {
            $original_srcset[] = $original_image[0] . ' ' . $original_image[1] . 'w';
            $sizes[] = '(max-width: ' . $original_image[1] . 'px) 100vw';
        }
    }

    // Use the 'large' size for default src, width, and height
    $default_image = wp_get_attachment_image_src($img_id, 'large');
    $default_url = $default_image[0];
    $width = $default_image[1];
    $height = $default_image[2];
    $image_alt = $img_alt ?? get_post_meta($img_id, '_wp_attachment_image_alt', true);

    $original_srcset_attr = implode(', ', $original_srcset);
    $sizes_attr = implode(', ', array_reverse($sizes)) . ', 100vw';
    ?>
    <picture>
        <source srcset="<?php echo esc_attr($original_srcset_attr); ?>"
                sizes="<?php echo esc_attr($sizes_attr); ?>"
                type="image/<?php echo pathinfo($default_url, PATHINFO_EXTENSION); ?>">
        <img src="<?php echo esc_url($default_url); ?>"
             srcset="<?php echo esc_attr($original_srcset_attr); ?>"
             sizes="<?php echo esc_attr($sizes_attr); ?>"
             alt="<?php echo esc_attr($image_alt); ?>"
             width="<?php echo esc_attr($width); ?>"
             height="<?php echo esc_attr($height); ?>"
             loading="lazy"
             class="<?php echo $img_class; ?>">
    </picture>
<?php endif; ?>
