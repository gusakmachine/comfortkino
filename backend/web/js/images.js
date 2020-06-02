$(document).ready(function(){
    $('.viewers-wrapper').on('click', '.viewers-item', function () {
        var parent = $(this).parent();

        parent.children().removeClass('selected-item');
        $(this).addClass('selected-item');

        $(parent.attr('data-element-id')).val($(this).attr('data-name'));
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.' + $(input).attr('data-image-name')).attr('src', e.target.result).css('display', 'block');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.view-img-after-dwn').change(function() {
        readURL(this);
    });
});