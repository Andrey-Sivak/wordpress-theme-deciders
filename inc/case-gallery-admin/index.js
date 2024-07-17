jQuery(document).ready(function($) {
    var frame;
    $('#add_gallery_images').click(function(e) {
        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Выбрать изображения',
            button: {
                text: 'Использовать эти изображения'
            },
            multiple: true
        });

        frame.on('select', function() {
            var attachments = frame.state().get('selection').toJSON();
            var container = $('#case-gallery-container');
            var imageIds = [];

            $.each(attachments, function(index, attachment) {
                container.append(
                    '<div class="gallery-image-wrapper" data-id="' + attachment.id + '">' +
                    '<img src="' + attachment.sizes.thumbnail.url + '" />' +
                    '<button type="button" class="remove-image">Удалить</button>' +
                    '</div>'
                );
                imageIds.push(attachment.id);
            });

            var currentIds = $('#case_gallery_images').val();
            var newIds = currentIds ? currentIds + ',' + imageIds.join(',') : imageIds.join(',');
            $('#case_gallery_images').val(newIds);
        });

        frame.open();
    });

    $('#case-gallery-container').on('click', '.remove-image', function() {
        var wrapper = $(this).parent();
        var imageId = wrapper.data('id');
        wrapper.remove();

        var currentIds = $('#case_gallery_images').val().split(',');
        var newIds = currentIds.filter(function(id) { return id != imageId; });
        $('#case_gallery_images').val(newIds.join(','));
    });
});