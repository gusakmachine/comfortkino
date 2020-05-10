$(document).ready(function(){
    // Owl carousel
    var owl = $(".info-carousel"),
        time = 25000,
        bar,
        tick,
        isPause = false,
        percentTime;

    // Init the carousel
    owl.owlCarousel({
        items: 1,
        loop: true,
        center: true,
        margin: 20,
        autoWidth:true,
        nav: true,
        navText: ['<svg><use href=\"/img/static/icons/icons.svg#arrow-without-bottom\"\" /></svg>', '<svg><use href=\"/img/static/icons/icons.svg#arrow-without-bottom\"\" /></svg>'],
        onInitialized: start,
        onTranslate: function () {
            $(".owl__progress-indicator").width(0);
        },
        onDragged: moved,
    });

    // progress bar
    function start() {
        // next bar
        bar = $(".info-carousel .owl-item.center > div > .owl__progress-bar > .owl__progress-indicator");
        //reset timer
        percentTime = 0;
        // run interval every 0.01 second
        tick = setInterval(interval, 10);
    }

    function interval() {
        if(isPause === false){
            percentTime += 1 / (time / 1000);
            bar.width(percentTime+"%");
            // if percentTime is equal or greater than 100
            if(percentTime >= 100) {
                // slide to next item
                owl.trigger('next.owl.carousel');
                moved();
            }
        }
    }

    // moved callback
    function moved(){
        // clear interval
        clearTimeout(tick);
        // start again
        start();
    }

    // to make pause .progress-indicator on mouseover
    owl.on('mouseover',function(){
        isPause = true;
    });
    owl.on('mouseout',function(){
        isPause = false;
    });

    // on click owl-buttons
    $(".owl-prev").on('click', function () {
        moved();
    });
    $(".owl-next").on('click', function () {
        moved();
    });

    //.day-list x-scroll
    var dayListWrapper = $('.day-list-wrapper');
    var dayList = $('.day-list');
    var dayListBtn = document.getElementsByClassName('day-list__btn');

    var scrollVal = dayList.width();

    var mousedown = false;
    var mousemove = false;

    // show-hide day-list-btns
    function changeDisplayDayListBTN() {
        if (dayListWrapper.offset().left == dayList.offset().left) {
            dayListBtn[0].classList.add('disabled');
            dayListBtn[1].classList.remove('disabled');
        } else if (dayList[0].scrollWidth - dayListWrapper.outerWidth() == dayListWrapper.scrollLeft()) {
            dayListBtn[0].classList.remove('disabled');
            dayListBtn[1].classList.add('disabled');
        } else {
            dayListBtn[0].classList.remove('disabled');
            dayListBtn[1].classList.remove('disabled');
        }
    }

    dayListWrapper[0].addEventListener('scroll', changeDisplayDayListBTN);
    dayListWrapper[0].addEventListener('mousedown', function () { mousedown = true; });
    dayListWrapper[0].addEventListener('mouseup', function () { mousedown = false; });
    dayListWrapper[0].addEventListener('mousemove', function () {
        if (mousedown)
            mousemove = true;
        else mousemove = false;
    });

    dayListWrapper[0].addEventListener('scroll', changeDisplayDayListBTN);

    // scroll with buttons
    dayListBtn[0].addEventListener('click', function () {
        dayListWrapper[0].scrollBy({
            top:0,
            left: -scrollVal,
            behavior: 'smooth'
        });
    });
    dayListBtn[1].addEventListener('click', function () {
        dayListWrapper[0].scrollBy({
            top:0,
            left: scrollVal,
            behavior: 'smooth'
        });
    });

    // Session schedule
    var sessions = [];
    var date = $('.day--active').attr('data-date');

    function addMoviesForThisDay(data) {
        if (data) sessions[date] = data;

        $('.films').empty();
        $('.films').append(sessions[date]);

        $('.film__poster, .film__trailer-preview').magnificPopup({
            type:'iframe',
            mainClass: 'mfp-fade',
            showCloseBtn:false,
        });
    }

    //Ajax-request and add/remove highlight
    function getMoviesForThisDay() {
        var request = $.ajax({
            type: 'post',
            url: getMoviesURL,
            data: {
                date: date
            }
        });

        request.done(function (data) {
            if (data)
                addMoviesForThisDay(data);
            else addMoviesForThisDay('<span class="day-list-error">Нет сеансов</span>');
        });

        request.fail(function () {
            addMoviesForThisDay('<span class="day-list-error">Тех. неполадка</span>');
        });
    }



    $('.day-list').on('click', '.day', function () {
        // if the user does not scroll, show movies for this day
        if (mousemove) {
            mousemove = false;
            return false;
        }

        $('.day').removeClass('day--active');
        $(this).addClass('day--active');

        date = $(this).attr('data-date');
        date = $(this).attr('data-date');

        if (!sessions[date]) {
            getMoviesForThisDay(date);
        } else addMoviesForThisDay();
    });

    // Section soon: hide-show posters
    if ($('.posters__item').length < 5) {
        $('#posters__toggler').hide();
    } else {
        $('#posters__toggler').click(function() {
            $('#posters').toggleClass('posters--open');
            $('#posters__toggler span').toggleClass('posters__toggler--hide');
        });
    }

    $('.film__trailer').magnificPopup({
        type:'iframe',
        mainClass: 'mfp-fade',
        showCloseBtn:false,
    });

    getMoviesForThisDay();

});
