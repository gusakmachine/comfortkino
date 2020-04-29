<?php

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\assets\AppAsset;

use frontend\widgets\PopupCities\PopupCities;
use frontend\widgets\PopupTickets\PopupTickets;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>
        var getMoviesURL = '<?= Url::to(['site/movies']) ?>';
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= PopupCities::widget() ?>
<?= PopupTickets::widget() ?>

<div class="page-background" style="background-image: url(img/background/50ee4a7ce72c7426ffe2eff30267411e.jpg)"></div>
<header class="header">
    <a href="<?= Url::home()?>"><img src="<?= Yii::getAlias('@logo-image'); ?>" alt="Кинотеатр Русь, логотип" class="header__logo"></a>
    <button class="header__town-link" data-sh="#popup-cities">
        <span class="header__town">Москва</span>
        <svg class="header__arrow-without-bottom"><use href="<?= Yii::getAlias('@svg:#arrow-without-bottom'); ?>"></use></svg>
    </button>
</header>

<?= $content ?>

<footer class="footer">
    <div class="container">
        <h4 class="footer__title">Контакты</h4>
        <div class="footer__contacts">
            <div class="row">
                <a class="footer__map" href="https://www.google.com/maps/place/%D0%9A%D1%96%D0%BD%D0%BE%D0%BF%D0%B0%D0%BB%D0%B0%D1%86+%D0%A3%D0%BA%D1%80%D0%B0%D1%97%D0%BD%D0%B0/@48.56272,39.3153204,16.92z/data=!4m5!3m4!1s0x0:0x5be417229d8bd3c1!8m2!3d48.5628691!4d39.3164075?hl=ru" target="_blank" style="background-image: url('img/map-place-kinorus.png')"></a>
                <div class="footer__info">
                    <div class="footer__tel">
                        <p><a href="tel:380999323615">+380 (99) 9323615</a></p>
                        <p><a href="tel:380999323615">+380 (99) 9323615</a></p>
                    </div>
                    <div class="footer__socials">
                        <a class="sm--facebook" href="#" target="_blank" rel="nofollow noopener">
                            <span>
                                <svg><use href="/img/static/icons/icons.svg#facebook" /></svg>
                            </span>
                        </a>
                        <a class="sm--insta" href="#" target="_blank" rel="nofollow noopener">
                            <span>
                                <svg><use href="/img/static/icons/icons.svg#inst" /></svg>
                            </span>
                        </a>
                        <a class="sm--vk" href="#" target="_blank" rel="nofollow noopener">
                            <span>
                                <svg><use href="/img/static/icons/icons.svg#vk" /></svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="popup" class="popup">
    <div class="popup-content">
        <div id="popupClose" class="popup__close">
            <svg viewBox="0 0 18 18" width="18" height="18">
                <path d="M15.5 17.6l-6.5-6.5-6.5 6.5c-.6.6-1.5.6-2.1 0-.6-.6-.6-1.5 0-2.1l6.5-6.5-6.5-6.5c-.6-.6-.6-1.5 0-2.1.6-.6 1.5-.6 2.1 0l6.5 6.5 6.5-6.5c.6-.6 1.5-.6 2.1 0 .6.6.6 1.5 0 2.1l-6.5 6.5 6.5 6.5c.6.6.6 1.5 0 2.1-.3.3-.6.4-1 .4s-.8-.2-1.1-.4z"></path>
            </svg>
        </div>
        <div class="popup__header">
            <h3 class="popup__header-title">Удивительное путешествие доктора Дулиттла</h3>
            <div class="popup__header-subtitle">
                <a href="#" class="popup__town-toggler">
                    <span href="#" class="popup__town">Луганск</span>
                </a>
                <span>Зал 4</span>
                <span>20 февраля 2020, 13:40</span>
            </div>
        </div>
        <div class="popup__timetable">
            <div class="flex-wrapper">
                <a href="#" class="popup__timetable-link film__sessions-info">
                    <span class="popup__timetable-time film__session-time">17:00</span>
                    <span class="popup__timetable-price film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="popup__timetable-link film__sessions-info">
                    <span class="popup__timetable-time film__session-time">19:20</span>
                    <span class="popup__timetable-price film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="popup__timetable-link film__sessions-info">
                    <span class="popup__timetable-time film__session-time">21:40</span>
                    <span class="popup__timetable-price film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="popup__timetable-link film__sessions-info">
                    <span class="popup__timetable-time film__session-time">23:55</span>
                    <span class="popup__timetable-price film__session-price">от 380 ₽</span>
                </a>
            </div>
        </div>
        <div class="popup__scheme">
            <div class="popup__scheme-inner dragscroll">
                <div class="scheme">
                    <div class="scheme__header">
                        <div class="scheme-ticket">
                            <div class="place scheme-ticket__place"></div>
                            <div class="scheme-ticket__price rub">300</div>
                        </div>
                        <div class="scheme-ticket">
                            <div class="place scheme-ticket__place" data-price="1"></div>
                            <div class="scheme-ticket__price rub">400</div>
                        </div>
                        <div class="scheme-ticket">
                            <div class="place scheme-ticket__place" data-sold="true"></div>
                            <div class="scheme-ticket__price">Место занято</div>
                        </div>
                    </div>
                    <div id="scheme__body" class="scheme__body">
                        <div id="scheme-menu" class="scheme-menu">
                            <div class="place-rows" style="left: 0px;">
                                <span class="place-row" style="top: 0px;">1</span>
                                <span class="place-row" style="top: 45px;">2</span>
                                <span class="place-row" style="top: 90px;">3</span>
                                <span class="place-row" style="top: 135px;">4</span>
                                <span class="place-row" style="top: 180px;">5</span>
                                <span class="place-row" style="top: 225px;">6</span>
                                <span class="place-row" style="top: 270px;">7</span>
                                <span class="place-row" style="top: 315px;">8</span>
                            </div>
                            <button class="place scheme-menu__place" data-price="0" style="left: 80px; top: 0px;">
                                <span class="place__number">15</span>
                                <div class="popover">
                                    <span class="big">300 ₽</span>
                                    <span>1 ряд, 1 место</span>
                                </div>
                            </button>
                            <button class="place scheme-menu__place" data-price="1"style="left: 115px; top: 0px;">
                                <span class="place__number">14</span>
                                <div class="popover">
                                    <span class="big">200 ₽</span>
                                    <span>1 ряд, 2 место</span>
                                </div>
                            </button>
                            <button class="place scheme-menu__place" data-price="0" style="left: 160px; top: 0px;">
                                <span class="place__number">13</span>
                                <div class="popover">
                                    <span class="big">400 ₽</span>
                                    <span>1 ряд, 3 место</span>
                                </div>
                            </button>
                            <button class="place scheme-menu__place" data-price="1" style="left: 195px; top: 0px;">
                                <span class="place__number">12</span>
                                <div class="popover">
                                    <span class="big">300 ₽</span>
                                    <span>1 ряд, 1 место</span>
                                </div>
                            </button>
                            <button class="place scheme-menu__place" data-price="1" style="left: 295px; top: 0px;">
                                <span class="place__number">12</span>
                                <div class="popover">
                                    <span class="big">300 ₽</span>
                                    <span>1 ряд, 1 место</span>
                                </div>
                            </button>
                            <button class="place scheme-menu__place" data-price="1" style="left: 395px; top: 0px;">
                                <span class="place__number">12</span>
                                <div class="popover">
                                    <span class="big">300 ₽</span>
                                    <span>1 ряд, 1 место</span>
                                </div>
                            </button>
                            <div class="place-rows" style="right: 0px;">
                                <span class="place-row" style="top: 0px;">1</span>
                                <span class="place-row" style="top: 45px;">2</span>
                                <span class="place-row" style="top: 90px;">3</span>
                                <span class="place-row" style="top: 135px;">4</span>
                                <span class="place-row" style="top: 180px;">5</span>
                                <span class="place-row" style="top: 225px;">6</span>
                                <span class="place-row" style="top: 270px;">7</span>
                                <span class="place-row" style="top: 315px;">8</span>
                            </div>
                        </div>
                    </div>
                    <div class="scheme__controls">
                        <div class="controls">
                            <button id="scheme__control-plus" class="control" type="button">
                                <svg width="14" height="14" viewBox="0 0 14 14">
                                    <path d="M12 5h-3v-3c0-1.1-.9-2-2-2s-2 .9-2 2v3h-3c-1.1 0-2 .9-2 2s.9 2 2 2h3v3c0 1.1.9 2 2 2s2-.9 2-2v-3h3c1.1 0 2-.9 2-2s-.9-2-2-2z"></path>
                                </svg>
                            </button>
                            <button id="scheme__control-minus" class="control" type="button">
                                <svg width="14" height="14" viewBox="0 0 14 14">
                                    <path d="M12 5h-10c-1.1 0-2 .9-2 2s.9 2 2 2h10c1.1 0 2-.9 2-2s-.9-2-2-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup__text">
            <div class="tickets popup__content-tickets">
                <button id="tickets__result" class="tickets__result">Выберите места</button>
                <button class="tickets__btn">Купить билеты</button>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
