$(document).ready(function() {
    // Show-hide
    $('body').on('click', '[data-SH]', function () {
        if ($($(this).data('sh')).css('display') == 'none')
            $($(this).data('sh')).fadeIn().css('display', 'flex');
        else $($(this).data('sh')).fadeOut().css('display', 'flex');
    });
});