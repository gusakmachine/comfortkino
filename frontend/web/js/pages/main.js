$(document).ready(function(){
    $('.day-list').owlCarousel({
        center: false,
        items:9,
        loop:false,
        margin:10,
        nav: true,
        autoplay: false,
        //navText: ['<div class="owl-arrow nav-left"><div class="owl-arrownav"><span aria-label="Previous">&lsaquo;</span></div></div>','<div class="owl-arrow nav-right"><div class="owl-arrownav"><span aria-label="Next">&rsaquo;</span></div></div>']
        navText: ['<button class="day-list__btn --prev"></button>','<button class="day-list__btn --next"></button>']
    });

    // Owl Carousel
    var owl = $(".info-carousel"),
        time = 5000,
        bar,
        tick,
        isPause = false,
        percentTime;

    //Init the carousel
    owl.owlCarousel({
        items: 1,
        loop: true,
        center: true,
        margin: 20,
        autoWidth:true,
        nav: true,
        navText: ["", ""],
        onInitialized: start,
        onTranslate: function () {
            $(".owl__progress-indicator").width(0);
        },
        onDragged: moved,
    });


    function start() {
        //next bar
        bar = $(".info-carousel .owl-item.center > div > .owl__progress-bar > .owl__progress-indicator");
        //reset timer
        percentTime = 0;
        //run interval every 0.01 second
        tick = setInterval(interval, 10);
    }

    function interval() {
        if(isPause === false){
            percentTime += 1 / (time / 1000);
            bar.width(percentTime+"%");
            //if percentTime is equal or greater than 100
            if(percentTime >= 100) {
                //slide to next item
                owl.trigger('next.owl.carousel');
                moved();
            }
        }
    }

    //moved callback
    function moved(){
        //clear interval
        clearTimeout(tick);
        //start again
        start();
    }

    //to make pause .progress-indicator on mouseover
    owl.on('mouseover',function(){
        isPause = true;
    });
    owl.on('mouseout',function(){
        isPause = false;
    });

    //on click owl-buttons
    $(".owl-prev").on('click', function () {
        moved();
    });
    $(".owl-next").on('click', function () {
        moved();
    });



    // Tabs session schedule
    $('.tabs__link').on('click', function () {   
        $('.tabs__link').removeClass('day--active');
        $('.tabs__content').hide();
        $index = $(this).attr('data-idx');
        $(this).addClass('day--active');
        $('.tabs__content').eq($index).show();
    })

    // Posters 

    if ($('.posters__item').length < 5) {
        $('#posters__toggler').hide();
    } else {
        $('#posters__toggler').click(function() {
            $('#posters').toggleClass('posters--open');
            $('#posters__toggler span').toggleClass('posters__toggler--hide');
        });
    }

    // popup

    let schemeMaxScale = 2; // Максимальное значение до которого можно увеличиться
    let schemeMinScale = 1; // Минимальное значение до которого можно отдалиться
    let schemeScale = 1; // Стандартное значение
    let schemeScaleMultiplier = 0.25; // Шаг с которым приближается или отдаляется

    let orderPlacesCount = 0;
    let orderPlacesPrice = 0;
    let placePrices = [];

    // parse tickets prices
    $('.scheme-ticket__price.rub').each(function() {
        placePrices.push(parseInt($(this).html()));
    });

    // PopupToggle
    $('.film__sessions-info').click(function() {
        $('#popup').fadeIn().css('display','flex');
    });

    // PopupClose
    $('#popupClose').click(function() {
        $('#popup').fadeOut().css('display','flex');
    });

    // scheme approximation
    $('#scheme__control-plus').click(function() {
        $('#scheme__body').css('transform', 'scale(' + (schemeScale < schemeMaxScale ? schemeScale += schemeScaleMultiplier : schemeMaxScale) + ')');
    });

    // scheme estrangement
    $('#scheme__control-minus').click(function() {
        $('#scheme__body').css('transform', 'scale(' + (schemeScale > schemeMinScale ? schemeScale -= schemeScaleMultiplier : schemeMinScale) + ')');
    });

    // tickets Prices
    $('.scheme-menu__place').click(function(e) {    
        if(!$(this).attr('data-sold')) {

            $(this).toggleClass('place--active')

            if ($(this).hasClass("place--active")) {
                orderPlacesPrice += placePrices[parseInt($(this).attr('data-price'))];
                orderPlacesCount++;

            } else {
                orderPlacesPrice -= placePrices[parseInt($(this).attr('data-price'))];
                orderPlacesCount--;
            }
        }
        $('#tickets__result').html(orderPlacesCount == 0 ? "Выберите места" : orderPlacesCount + pluralForm(orderPlacesCount, " билет", " билета", " билетов") +  " за " + orderPlacesPrice + " руб.")
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
        let n1 = n % 10;
        if (n > 10 && n < 20) return form5;
        if (n1 > 1 && n1 < 5) return form2;
        if (n1 == 1) return form1;
        return form5;
    }
});
