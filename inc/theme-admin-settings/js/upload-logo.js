jQuery(document).ready(function($) {
    $('#upload_logo_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Выбрать логотип',
            multiple: false
        }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="theme_settings[logo]"]').val(image_url);
                $('input[name="theme_settings[logo]"]').siblings('img').attr('src', image_url);
            });
    });
});