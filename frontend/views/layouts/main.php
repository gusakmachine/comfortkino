<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="page-background" style="background-image: url(img/background/50ee4a7ce72c7426ffe2eff30267411e.jpg)"></div>
<header class="header">
    <a href="index.html"><img src="img/logo.png" alt="Кинотеатр Русь, логотип" class="header__logo"></a>
    <a class="header__town-link">
        <span class="header__town">Москва</span>
    </a>
</header>

<?= Alert::widget() ?>
<?= $content ?>

<footer class="footer">
    <div class="container">
        <h4 class="footer__title">Контакты</h4>
        <div class="footer__contacts">
            <div class="row">
                <a class="footer__map" href="https://www.google.com/maps/place/%D0%9A%D1%96%D0%BD%D0%BE%D0%BF%D0%B0%D0%BB%D0%B0%D1%86+%D0%A3%D0%BA%D1%80%D0%B0%D1%97%D0%BD%D0%B0/@48.56272,39.3153204,16.92z/data=!4m5!3m4!1s0x0:0x5be417229d8bd3c1!8m2!3d48.5628691!4d39.3164075?hl=ru" target="_blank" style="background-image: url('img/map-place-kinorus.png')"></a>
                <div class="footer__info">
                    <div class="footer__tel">
                        <p>
                            <a href="tel:380999323615">+380 (99) 9323615</a>
                        </p>
                        <p>
                            <a href="tel:380999323615">+380 (99) 9323615</a>
                        </p>
                    </div>
                    <div class="footer__socials">
                        <a class="sm--facebook" href="#" target="_blank" rel="nofollow noopener">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path
                                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                        </svg>
                                </span>
                        </a>
                        <a class="sm--insta" href="#" target="_blank" rel="nofollow noopener">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                </span>
                        </a>
                        <a class="sm--vk" href="#" target="_blank" rel="nofollow noopener">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path class="st0"
                                              d="M13.162 18.994c.609 0 .858-.406.851-.915-.031-1.917.714-2.949 2.059-1.604 1.488 1.488 1.796 2.519 3.603 2.519h3.2c.808 0 1.126-.26 1.126-.668 0-.863-1.421-2.386-2.625-3.504-1.686-1.565-1.765-1.602-.313-3.486 1.801-2.339 4.157-5.336 2.073-5.336h-3.981c-.772 0-.828.435-1.103 1.083-.995 2.347-2.886 5.387-3.604 4.922-.751-.485-.407-2.406-.35-5.261.015-.754.011-1.271-1.141-1.539-.629-.145-1.241-.205-1.809-.205-2.273 0-3.841.953-2.95 1.119 1.571.293 1.42 3.692 1.054 5.16-.638 2.556-3.036-2.024-4.035-4.305-.241-.548-.315-.974-1.175-.974h-3.255c-.492 0-.787.16-.787.516 0 .602 2.96 6.72 5.786 9.77 2.756 2.975 5.48 2.708 7.376 2.708z" />
                                        </svg>
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <a class="footer__address" href="https://www.google.com/maps/place/%D0%9A%D1%96%D0%BD%D0%BE%D0%BF%D0%B0%D0%BB%D0%B0%D1%86+%D0%A3%D0%BA%D1%80%D0%B0%D1%97%D0%BD%D0%B0/@48.56272,39.3153204,16.92z/data=!4m5!3m4!1s0x0:0x5be417229d8bd3c1!8m2!3d48.5628691!4d39.3164075?hl=ru" target="_blank">ул. Оборонная, 4, Луганск, Луганская область, 91000</a>
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
