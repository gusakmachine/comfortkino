$(document).ready(function() {
    var files = [];
    var existing_gallery_names = [];

    $('.gallery-img').each(function (i) {
        existing_gallery_names[i] = $(this).attr('data-image-name');
        $(this).attr('data-egn', i);
    });

    var gallery = $('.gallery');
    var gallery_item = $('.gallery-item:first').clone();
    var gallery_image = $(gallery_item).children('.gallery-img');
    var gallery_input = $('.false-gallery-input:first');

    function readURL(input) {
        if (input.files && input.files[0]) {
            for (var i = 0; i < input.files.length; i++) {
                files[i] = input.files[i];
                $(gallery_image).attr('src', URL.createObjectURL(input.files[i]));
                $(gallery_image).attr('data-image-name', i);
                $(gallery).append($(gallery_item).clone());
            }
        }
    }

    $(gallery).on('click', '.gallery-delete-icon', function () {
        existing_gallery_names[$(this).siblings('.gallery-img').attr('data-egn')] = 0;
        delete files[$(this).siblings('.gallery-img').attr('data-image-name')];
        $(this).parent().remove();
    });

    $('.false-gallery-input').change(function() {
        readURL(this);
    });

    $('#w0').submit(function (e) {
        e.preventDefault();
        $(gallery_input).remove();

        var formData = new FormData(this);

        files.forEach(function (value, i) {
            formData.set('Movies[files_gallery][' + i + ']', value);
        });
        existing_gallery_names.forEach(function (value, i) {
            formData.set('existing_gallery_names[' + i + ']', value);
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
    });
});