//govnokod, rewrite, even not try sort out

var hall = $('.hall');
var rows = $('.rows.example').clone().removeClass('example');
var place = $('.places-wrapper:first').clone();

var selected_places;

$('.rows.example').remove();
$('.places-wrapper:first.example').remove();

function setInputNames(place_wrapper, current_row, numberPlaces) {
    $(place_wrapper).children('.place-price-id').attr('name', 'Places['+$(current_row).attr('data-row-number')+']['+numberPlaces+'][price_id]');
    $(place_wrapper).children('.place-color-id').attr('name', 'Places['+$(current_row).attr('data-row-number')+']['+numberPlaces+'][color_id]');
    $(place_wrapper).children('.place-graphic-display').attr('name', 'Places['+$(current_row).attr('data-row-number')+']['+numberPlaces+'][graphic_display]');
}
function setPrices(places_wrapper) {
    var price = Number($('.price').val());

    $(places_wrapper).children('.place-price').html(price);
    $(places_wrapper).children('.place-price-id').attr('value', price);
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
function countPlaces(rows) {
    $(rows).each(function () {
        if($(this).children('.places-wrapper').length != 0) {
            var current_row = this;
            var currRowNumber = Number($(this).attr('data-row-number'));

            $(this).children('.places-wrapper').each(function (index) {
                $(this).children('.places').html(index + 1);
                setInputNames(this, current_row, index + 1);
                setGraphicDisplay($(this).children('.place-graphic-display'), currRowNumber, index + 1);
            });
        } else $(this).remove();
    });
}
function addPlaces(current_row, currRowNumber, numberPlaces) {
    var lastPlaceNumber = Number($(current_row).children('.places-wrapper:last').children('.places').html()) ;

    if (!lastPlaceNumber)
        lastPlaceNumber = 0;

    for (var i = 0; i < numberPlaces; i++) {
        var place_number = i + 1 + lastPlaceNumber;
        var place_clone = $(place).clone().children('.places').html(place_number).parent();

        setInputNames(place_clone, current_row, place_number);

        $(current_row).append(place_clone);

        setPrices($(current_row).children('.places-wrapper'));
        setColor($(current_row).children('.places-wrapper'));
        setGraphicDisplay($(place_clone).children('.place-graphic-display'), currRowNumber, place_number);
    }
}


$('.edit_rows').click(function () {
    for (var i = 0, numberRows = Number($('.number_rows').val()); i < numberRows; i++) {
        var current_row = $(rows).clone();

        $(hall).append($(current_row));
        countRows();

        addPlaces(current_row, Number($(current_row).attr('data-row-number')), Number($('.number_places').val()));
    }
});
$('.edit_place-price').click(function () {
    setColor(selected_places);
    setPrices(selected_places);
});
$('.delete-row').click(function () {
    var current_rows = $(selected_places).closest('.rows');

    $(selected_places).remove();
    countPlaces(current_rows);
    countRows();
});
$('.add_places').click(function () {
    var current_rows = $(selected_places).closest('.rows');

    $(current_rows).each(function () {
        addPlaces(this, Number($(this).attr('data-row-number')), Number($('.count-places').val()));
    });
});

$(function() {
    $(".hall").selectable({
        filter: ".places-wrapper",
        selected: function(event, ui) {
            selected_places = $('.places-wrapper.ui-selected');
        },
    });
});

countRows();

$('.rows.setup').each(function () {
    var current_row = this;
    var row_number = Number($(this).attr('data-row-number'));
    var places_wrapper = $(this).children('.places-wrapper');

    $(places_wrapper).each(function () {
        var place_number = Number($(this).children('.places').html());

        setInputNames(this, current_row, place_number);
        setGraphicDisplay($(this).children('.place-graphic-display'), row_number, place_number);
    });
});