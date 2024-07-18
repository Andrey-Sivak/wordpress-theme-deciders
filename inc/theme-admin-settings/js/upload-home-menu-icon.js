jQuery(document).ready(function($) {
    $('#upload_home_menu_icon_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Выбрать иконку',
            multiple: false
        }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                $('input[name="theme_settings[home_menu_icon]"]').val(image_url);
                $('input[name="theme_settings[home_menu_icon]"]').siblings('img').attr('src', image_url);
            });
    });
});