$('.clear-cash').click(function () {
    $.ajax({
        method: "POST",
        data: { clear_cash: true, cinema: $('#cinema').val() }
    }).done(function(msg) {
        alert(msg);
    });
});