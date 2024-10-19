jQuery(document).ready(function($) {
    var meta_image_frame;

    // Handle the media upload button
    $('.ts-portfolio-upload-image').click(function(e) {
        e.preventDefault();

        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        meta_image_frame = wp.media({
            title: 'Select or Upload Image',
            button: { text: 'Use this image' },
            multiple: false
        });

        meta_image_frame.on('select', function() {
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            $('#ts_portfolio_project_image_id').val(media_attachment.id);
            $('.ts-portfolio-image-wrapper').html('<img src="' + media_attachment.url + '" style="max-width:100%;" />');
        });

        meta_image_frame.open();
    });

    // Handle remove image button
    $('.ts-portfolio-remove-image').click(function() {
        $('#ts_portfolio_project_image_id').val('');
        $('.ts-portfolio-image-wrapper').html('');
    });
});
