$(document).ready(function() {
    var schemeMaxScale = 2;
    var schemeMinScale = 1;
    var schemeScale = 1;
    var schemeScaleMultiplier = 0.25;

    var orderPlacesCount;
    var orderPlacesPrice;

    var csrfParam = $('meta[name=csrf-param]').attr("content");
    var csrfToken = $('meta[name=csrf-token]').attr("content");

    // scheme approximation
    $('#popup-tickets').on('click', '#scheme__control-plus', function () {
        $('#scheme__body').css('transform', 'scale(' + (schemeScale < schemeMaxScale ? schemeScale += schemeScaleMultiplier : schemeMaxScale) + ')');
    });

    // scheme estrangement
    $('#popup-tickets').on('click', '#scheme__control-minus', function () {
        $('#scheme__body').css('transform', 'scale(' + (schemeScale > schemeMinScale ? schemeScale -= schemeScaleMultiplier : schemeMinScale) + ')');
    });

    // tickets Prices
    $('#popup-tickets').on('click', '.scheme-menu__place', function (e) {
        if (!$(this).attr('data-sold')) {

            $(this).toggleClass('place--active')

            if ($(this).hasClass("place--active")) {
                orderPlacesPrice += parseInt($(this).find('.big.rub').text());
                orderPlacesCount++;
            } else {
                orderPlacesPrice -= parseInt($(this).find('.big.rub').text());
                orderPlacesCount--;
            }
        }
        $('#tickets__result').html(orderPlacesCount === 0 ? "Выберите места" : orderPlacesCount + pluralForm(orderPlacesCount, " билет", " билета", " билетов") + " за " + orderPlacesPrice + " руб.")
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
        if (n1 === 1) return form1;
        return form5;
    }

    function getPopupTickets(sessionID, timeID) {
        $('#popup-tickets').empty();

        orderPlacesCount = 0;
        orderPlacesPrice = 0;

        var request = $.ajax({
            type: 'post',
            url: getTicketsURL,
            data: {
                sessionID,
                timeID,
                [csrfParam]: csrfToken,
            }
        });
        request.done(function (data) {
            if (data) {
                $('#popup-tickets').append(data);
                dragscroll.reset();

            } else {
                $('#popup-tickets').append('<span class="popup-tickets__error">Нет данных</span>');
            }
        });

        request.fail(function () {
            $('#popup-tickets').append('<span class="popup-tickets__error">Тех. неполадка</span>');
        });
    }

    $('body').on('click', '.film__sessions-info', function () {
        getPopupTickets($(this).attr('data-sessionid'), $(this).attr('data-timeid'));
    });
});