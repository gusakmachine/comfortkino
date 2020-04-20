$(document).ready(function() {
    var schemeMaxScale = 2;
    var schemeMinScale = 1;
    var schemeScale = 1;
    var schemeScaleMultiplier = 0.25;

    var orderPlacesCount = 0;
    var orderPlacesPrice = 0;
    var placePrices = [];

    // parse tickets prices
    $('.scheme-ticket__price.rub').each(function () {
        placePrices.push(parseInt($(this).html()));
    });

    // scheme approximation
    $('#scheme__control-plus').click(function () {
        $('#scheme__body').css('transform', 'scale(' + (schemeScale < schemeMaxScale ? schemeScale += schemeScaleMultiplier : schemeMaxScale) + ')');
    });

    // scheme estrangement
    $('#scheme__control-minus').click(function () {
        $('#scheme__body').css('transform', 'scale(' + (schemeScale > schemeMinScale ? schemeScale -= schemeScaleMultiplier : schemeMinScale) + ')');
    });

    // tickets Prices
    $('.scheme-menu__place').click(function (e) {
        if (!$(this).attr('data-sold')) {

            $(this).toggleClass('place--active')

            if ($(this).hasClass("place--active")) {
                orderPlacesPrice += placePrices[parseInt($(this).attr('data-price'))];
                orderPlacesCount++;

            } else {
                orderPlacesPrice -= placePrices[parseInt($(this).attr('data-price'))];
                orderPlacesCount--;
            }
        }
        $('#tickets__result').html(orderPlacesCount == 0 ? "Выберите места" : orderPlacesCount + pluralForm(orderPlacesCount, " билет", " билета", " билетов") + " за " + orderPlacesPrice + " руб.")
    });

    /** Declension of Nouns with Numerals
     * @return string Correct form
     * @param n
     * @param form1
     * @param form2
     * @param form5
     */
    function pluralForm(n, form1, form2, form5) {
        n = Math.abs(n) % 100;
        var n1 = n % 10;
        if (n > 10 && n < 20) return form5;
        if (n1 > 1 && n1 < 5) return form2;
        if (n1 == 1) return form1;
        return form5;
    }
});