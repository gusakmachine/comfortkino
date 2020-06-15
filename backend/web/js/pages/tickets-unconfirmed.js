$("document").ready(function(){
    var timeout = 10000;
    var intervalID;

    function refresh() {
        $('.refresh-btn').click();
        intervalID = setTimeout(refresh, timeout);
    }

    $('.stop-refresh-btn').click(function () {
        clearTimeout(intervalID);
    });

    intervalID = setTimeout(refresh, timeout);
});
