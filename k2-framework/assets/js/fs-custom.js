/**
 * Created by Quan on 7/3/2017.
 */

var meida_frame, element;

jQuery(function ($) {
    meida_frame = wp.media({
        title: 'Select or Upload Media Of Your Chosen Persuasion',
        button: {
            text: 'Use this media'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    meida_frame.on('select', function () {

        // Get media attachment details from the meida_frame state
        var attachment = meida_frame.state().get('selection').first().toJSON();
        console.log(attachment);
        // Send the attachment URL to our custom image input field.
        var img = meida_frame.element.parents('.fs_meida').find('img.media-object');

        if (attachment.mime.indexOf('image') !== -1)
            img.attr('src', attachment.url);
        else
            img.attr('src', attachment.icon);

        // Send the attachment id to our hidden input
        var input = meida_frame.element.parents('.fs_meida').find('input.media_file');
        input.val(attachment.id);

        // Hide the add image link
        var button_upload = meida_frame.element.parents('.fs_meida').find('.upload_media');
        button_upload.addClass('hide');

        // Unhide the remove image link
        var button_remove = meida_frame.element.parents('.fs_meida').find('.remove_media');
        button_remove.removeClass('hide');
    });

    $(".fs_meida").on('click', '.upload_media', function (e) {
        e.preventDefault();
        e.stopPropagation();

        if (meida_frame) {
            meida_frame.element = $(this);
            meida_frame.open();
            return;
        }
    });

    $(".fs_meida").on('click', '.remove_media', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var element = $(this);
        // Send the attachment URL to our custom image input field.
        var img = element.parents('.fs_meida').find('img.media-object');
        img.attr('src', 'http://placehold.it/150x150');
        // Send the attachment id to our hidden input
        var input = element.parents('.fs_meida').find('input.media_file');
        input.val('');

        // Hide the add image link
        var button_upload = element.parents('.fs_meida').find('.upload_media');
        button_upload.removeClass('hide');

        // Unhide the remove image link
        var button_remove = element.parents('.fs_meida').find('.remove_media');
        button_remove.addClass('hide');
    });
});