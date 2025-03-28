jQuery(document).ready(function ($) {
	$('#upload_default_post_title_icon_button').click(function (e) {
		e.preventDefault();
		var image = wp
			.media({
				title: 'Select Icon',
				multiple: false,
			})
			.open()
			.on('select', function (e) {
				var uploaded_image = image.state().get('selection').first();
				var image_url = uploaded_image.toJSON().url;
				$('input[name="theme_settings[default_post_title_icon]"]').val(
					image_url,
				);
				$('input[name="theme_settings[default_post_title_icon]"]')
					.siblings('img')
					.attr('src', image_url);
			});
	});
});
