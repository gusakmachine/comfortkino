$(document).ready(function() {
    $('.popup-cities__addresses.tabs__content').eq($('.popup-cities__city.active').attr('data-idx')).addClass('tabs__content--active');

    $('.popup-cities__city').on('click', function () {
        $('.popup-cities__city').removeClass('active');
        $('.popup-cities__addresses.tabs__content').removeClass('tabs__content--active');
        $index = $(this).attr('data-idx');
        $(this).addClass('active');
        $('.popup-cities__addresses.tabs__content').eq($index).addClass('tabs__content--active');
    });
});