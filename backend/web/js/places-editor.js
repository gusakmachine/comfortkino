//govnokod, rewrite, even not try sort out

var hall = $('.hall');
var rows = $('.rows.example').clone().removeClass('example');
var place = $('.places-wrapper:first').clone();

$('.rows.example').remove();

function setPrices(places_wrapper) {
    var price = Number($('.price option:selected').html());
    var priceID = Number($('.price option:selected').val());

    $(places_wrapper).children('.place-price').html(price);
    $(places_wrapper).children('.place-price-id').attr('value', priceID);
}
function setColor(places_wrapper) {
    var color = $('.colors option:selected').html();
    var colorID = $('.colors option:selected').val();

    $(places_wrapper).children('.places').css('background-color', color);
    $(places_wrapper).children('.place-color-id').attr('value', colorID);
}
function setGraphicDisplay(place_graphic_display, numberRow, numberPlace) {
    $(place_graphic_display).attr('value', '{"top": "' + (numberRow * 35) + '", "left": "' + (numberPlace * 35) + '"}');
}
function countRows() {
    $('.rows').each(function (index) {
        $(this).attr('data-row-number', index + 1).children('.row_number').html(index + 1 + ' ряд');
    });
}
function setInputNames(place_wrapper, current_row, numberPlaces) {
    $(place_wrapper).children('.place-price-id').attr('name', 'Places['+$(current_row).attr('data-row-number')+']['+numberPlaces+'][price_id]');
    $(place_wrapper).children('.place-color-id').attr('name', 'Places['+$(current_row).attr('data-row-number')+']['+numberPlaces+'][color_id]');
    $(place_wrapper).children('.place-graphic-display').attr('name', 'Places['+$(current_row).attr('data-row-number')+']['+numberPlaces+'][graphic_display]');
}
function addPlaces(current_row, currRowNumber, numberPlaces) {
    $(current_row).children('.places-wrapper').remove();

    for ( ; numberPlaces > 0 ; numberPlaces--) {
        var place_clone = $(place).clone().children('.places').html(numberPlaces).parent();

        setInputNames(place_clone, current_row, numberPlaces);

        $(current_row).children('.row_number').after(place_clone);

        setPrices($(current_row).children('.places-wrapper'));
        setColor($(current_row).children('.places-wrapper'));
        setGraphicDisplay($(place_clone).children('.place-graphic-display'), currRowNumber, numberPlaces);
    }
}
function rowsHandler() {
    var current_row = $(this).closest('.rows');

    if ($(this).hasClass('delete-row')) {
        $(current_row).remove();
        countRows();
    } else if ($(this).hasClass('change-count-places'))
        addPlaces($(current_row), Number($(current_row).attr('data-row-number')), $(current_row).children('.places-edit-menu').children('.change-count').val());
}


$('.edit_rows').click(function () {
    var current_row = $(rows).clone();

    $(hall).append($(current_row));
    countRows();

    for (var i = 0, numberRows = $('.number_rows').val(); i < numberRows; i++)
        addPlaces(current_row, Number($(current_row).attr('data-row-number')), Number($(this).siblings('.number_places').val()));

    $(current_row).on('click', '.delete-row, .change-count-places', rowsHandler);
});

$('.edit_place-price').click(function () {
    var startRows = Number($('.start_row').val());
    var endRows = Number($('.end_row').val());
    var startPlaces = Number($('.start_place').val());
    var endPlaces = Number($('.end_place').val());

    $('.rows').each(function () {
        var row_number = Number($(this).attr('data-row-number'));

        if (row_number > startRows - 1 && row_number < endRows + 1) {
            var places_wrapper = $(this).children('.places-wrapper');

            $(places_wrapper).each(function () {
                var place_number = Number($(this).children('.places').html());

                if (place_number > startPlaces - 1 && place_number < endPlaces + 1) {
                    setColor(this)
                    setPrices(this);
                }
            });
        }
    });
});

$('.rows').on('click', '.delete-row, .change-count-places', rowsHandler);
$('.rows.setup').each(function () {
    var current_row = this;
    var row_number = Number($(this).attr('data-row-number'));
    var places_wrapper = $(this).children('.places-wrapper');

    $(places_wrapper).each(function () {
        var place_number = Number($(this).children('.places').html());

        setInputNames(this, current_row, place_number);
        setGraphicDisplay($(this).children('.place-graphic-display'), row_number, place_number);
    });

    setPrices($(this).children('.places-wrapper'));
    setColor($(this).children('.places-wrapper'));
});