jQuery(document).ready(function ($) {
	var socialLinkIndex = $('#social-links-container .social-link-item').length;

	$('#add-social-link').on('click', function () {
		var newField =
			'<div class="social-link-item">' +
			'<input type="hidden" name="theme_settings[social_links][' +
			socialLinkIndex +
			'][icon]" class="social-icon-input">' +
			'<img src="" alt="Social Icon" style="max-width:50px;height:auto;vertical-align:middle;margin-right:10px;" class="hidden">' +
			'<input type="button" class="button upload-social-icon" value="Set Icon" style="vertical-align:middle;">' +
			'<input type="url" name="theme_settings[social_links][' +
			socialLinkIndex +
			'][url]" placeholder="Link" class="regular-text">' +
			'<button type="button" class="button remove-social-link">Remove</button>' +
			'</div>';
		$('#social-links-container').append(newField);
		socialLinkIndex++;
	});

	$(document).on('click', '.remove-social-link', function () {
		$(this).closest('.social-link-item').remove();
	});

	$(document).on('click', '.upload-social-icon', function (e) {
		e.preventDefault();
		var button = $(this);
		var customUploader = wp
			.media({
				title: 'Select Icon',
				library: {
					type: 'image',
				},
				button: {
					text: 'Use This Image',
				},
				multiple: false,
			})
			.on('select', function () {
				var attachment = customUploader
					.state()
					.get('selection')
					.first()
					.toJSON();
				button.siblings('input.social-icon-input').val(attachment.url);
				button.siblings('img').attr('src', attachment.url);
				button.siblings('img').removeClass('hidden');
				button.val('Change Icon');
			})
			.open();
	});
});
