$(document).ready(function() {
    var files = [];
    var existing_images = [];
    var to_delete_gallery_images = [];

    var gallery = $('.gallery');
    var gallery_item = $('.gallery-item:first').clone().css('display', 'flex');
    var gallery_image = $(gallery_item).children('.gallery-img');
    var gallery_input = $('.false-gallery-input:first');

    $('.gallery-img:first').remove();

    $('.gallery-img').each(function () {
        existing_images.push($(this).attr('data-image-name'));
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            for (var i = 0; i < input.files.length; i++)
                if (existing_images.indexOf(input.files[i].name) === -1) {
                    files[i] = input.files[i];
                    $(gallery_image).attr('src', URL.createObjectURL(input.files[i]));
                    $(gallery_image).attr('data-image-name', i);
                    $(gallery).append($(gallery_item).clone());
                }
        }
    }

    $('.false-gallery-input').change(function() {
        readURL(this);
    });

    $(gallery).on('click', '.gallery-delete-icon', function () {
        to_delete_gallery_images.push($(this).siblings('.gallery-img').attr('data-image-idx'));
        delete files[$(this).siblings('.gallery-img').attr('data-image-name')];
        $(this).parent().remove();
    });

    $('#w0').on('beforeSubmit', function(e) {
        $(gallery_input).remove();

        var formData = new FormData(this);

        files.forEach(function (value, i) {
            formData.set('Movies[files_gallery][' + i + ']', value);
        });
        to_delete_gallery_images.forEach(function (value, i) {
            formData.set('to_delete_gallery_images[' + i + ']', value);
        });

        $.ajax({
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(data){
                console.log(data);
            }
        });

        return false;
    });
});
