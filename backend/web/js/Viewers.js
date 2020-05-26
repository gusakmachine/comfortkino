$(document).ready(function(){
    $('.viewers-wrapper').on('click', '[data-name]', function () {
        var parent = $(this).parent();
        parent.children().removeClass('selected-item');
        $(this).addClass('selected-item');
        $(parent.attr('data-element-name')).val($(this).attr('data-name'));
    });
});