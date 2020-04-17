<?php

/* @var $this yii\web\View */
use \yii\helpers\Url;
use frontend\assets\MainAsset;

$this->title = 'My Yii Application';

MainAsset::register($this);
?>
<div class="info-carousel owl-carousel">
    <div>
        <div class="owl-item__blurred-img" style="background-image: url(img/background/50ee4a7ce72c7426ffe2eff30267411e.jpg)"></div>
        <a href="#" class="owl-item__film-poster" style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)"></a>
        <div class="film">
            <a href="#" class="film__details-link">
                <span class="film__genre">жанр</span>
                <h1 class="film__title">Название фильма 1</h1>
            </a>
            <div class="film__short-info">
                <a href="#" class="film__trailer">Смотреть трейлер</a>
                <span class="film__age-rating">16+</span>
            </div>
            <h5 class="film__upcoming-sessions">Ближайшие сеансы 01.01:</h5>
            <div class="flex-wrapper">
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">19:20</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">21:40</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">23:55</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info blue">
                    <span class="film__session-time__more">Ещё 24</span>
                </a>
            </div>
        </div>
        <div class="owl__progress-bar">
            <div class="owl__progress-indicator"></div>
        </div>
    </div>
    <div>
        <div class="owl-item__blurred-img" style="background-image: url(img/background/50ee4a7ce72c7426ffe2eff30267411e.jpg)"></div>
        <a href="#" class="owl-item__film-poster" style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)"></a>
        <div class="film">
            <a href="#" class="film__details-link">
                <span class="film__genre">жанр</span>
                <h1 class="film__title">Название фильма 2</h1>
            </a>
            <div class="film__short-info">
                <a href="#" class="film__trailer">Смотреть трейлер</a>
                <span class="film__age-rating">16+</span>
            </div>
            <h5 class="film__upcoming-sessions">Ближайшие сеансы 01.01:</h5>
            <div class="flex-wrapper">
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">19:20</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">21:40</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info">
                    <span class="film__session-time">23:55</span>
                    <span class="film__session-price">от 380 ₽</span>
                </a>
                <a href="#" class="film__sessions-info blue">
                    <span class="film__session-time__more">Ещё 24</span>
                </a>
            </div>
        </div>
        <div class="owl__progress-bar">
            <div class="owl__progress-indicator"></div>
        </div>
    </div>
</div>
<section class="session-schedule">
    <h1 class="session-schedule__title">Расписание сеансов</h1>
    <div class="tabs">
        <div class="pos-relative wrapper">
            <div class="day-list-wrapper">
                <nav class="day-list tabs__header owl-carousel" id="day-list">
                    <button class="day day--active tabs__link" type="button" data-idx="0">
                        <span class="day__week">Сегодня</span>
                        <span class="day__date">31 января</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="1">
                        <span class="day__week">Завтра</span>
                        <span class="day__date">01 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="2">
                        <span class="day__week">Воскресенье</span>
                        <span class="day__date">02 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="3">
                        <span class="day__week">Понедельник</span>
                        <span class="day__date">03 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="4">
                        <span class="day__week">Вторник</span>
                        <span class="day__date">04 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="5">
                        <span class="day__week">Среда</span>
                        <span class="day__date">05 февраля</span>
                    </button>
                    <div class="days__etc">
                        <span>...</span>
                    </div>
                    <button class="day tabs__link" type="button" data-idx="6">
                        <span class="day__week">Четверг</span>
                        <span class="day__date">06 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="7">
                        <span class="day__week">Пятница</span>
                        <span class="day__date">07 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="8">
                        <span class="day__week">Суббота</span>
                        <span class="day__date">08 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="9">
                        <span class="day__week">Воскресенье</span>
                        <span class="day__date">09 февраля</span></button>
                    <button class="day tabs__link" type="button" data-idx="10">
                        <span class="day__week">Четверг</span>
                        <span class="day__date">13 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button"  data-idx="11">
                        <span class="day__week">Пятница</span>
                        <span class="day__date">14 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button"  data-idx="12">
                        <span class="day__week">Суббота</span>
                        <span class="day__date">15 февраля</span>
                    </button>
                    <button class="day tabs__link" type="button"  data-idx="13">
                        <span class="day__week">Воскресенье</span>
                        <span class="day__date">16 февраля</span>
                    </button>
                </nav></div>
        </div>
        <div class="films tabs__body">
            <div class="tabs__content tabs__content--active">
                <div class="films-item">
                    <div class="wrapper">
                        <a class="film__play" href="#">
                            <svg class="film__play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                                <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
                            </svg>
                        </a>
                        <a href="#" class="film__poster" style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)"></a>
                        <a href="#" class="film__trailer-preview" style="background-image: url(img/youtube-preview/maxresdefault.jpg)"></a>
                    </div>
                    <div class="film">
                        <div class="top-left-content">
                            <div class="left-content">
                                <p class="film__label">
                                    <span class="film__country">Страна 1, Страна 2</span>
                                    <span class="film__genre">жанр</span>
                                    <span class="film__duration">0 часов 0 минут</span>
                                </p>
                                <a href="#" class="film__title">Название фильма</a>
                            </div>
                            <span class="film__age-rating">16+</span>
                        </div>
                        <div class="flex-wrapper">
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">19:20</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">21:40</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">23:55</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs__content">
                <div class="films-item">
                    <div class="wrapper">
                        <a class="film__play" href="#">
                            <svg class="film__play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                                <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
                            </svg>
                        </a>
                        <a href="#" class="film__poster" style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)"></a>
                        <a href="#" class="film__trailer-preview" style="background-image: url(img/youtube-preview/maxresdefault.jpg)"></a>
                    </div>
                    <div class="film">
                        <div class="top-left-content">
                            <div class="left-content">
                                <p class="film__label">
                                    <span class="film__country">Страна 1, Страна 2</span>
                                    <span class="film__genre">жанр</span>
                                    <span class="film__duration">0 часов 0 минут</span>
                                </p>
                                <a href="#" class="film__title">Название фильма</a>
                            </div>
                            <span class="film__age-rating">16+</span>
                        </div>
                        <div class="flex-wrapper">
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">19:20</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">21:40</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">23:55</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="films-item">
                    <div class="wrapper">
                        <a class="film__play" href="#">
                            <svg class="film__play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                                <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
                            </svg>
                        </a>
                        <a href="#" class="film__poster" style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)"></a>
                        <a href="#" class="film__trailer-preview" style="background-image: url(img/youtube-preview/maxresdefault.jpg)"></a>
                    </div>
                    <div class="film">
                        <div class="top-left-content">
                            <div class="left-content">
                                <p class="film__label">
                                    <span class="film__country">Страна 1, Страна 2</span>
                                    <span class="film__genre">жанр</span>
                                    <span class="film__duration">0 часов 0 минут</span>
                                </p>
                                <a href="#" class="film__title">Название фильма</a>
                            </div>
                            <span class="film__age-rating">16+</span>
                        </div>
                        <div class="flex-wrapper">
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">19:20</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">21:40</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                            <a href="#" class="film__sessions-info">
                                <span class="film__session-time">23:55</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="session-soon">
    <div class="container">
        <h2 class="session-soon__title">Скоро</h2>
        <div id="posters" class="posters posters--collapse session-soon__posters">
            <div class="posters__list">
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="posters__btn">
                    <a id="posters__toggler" class="posters__toggler">
                        <span>Показать все</span>
                        <span class="posters__toggler--hide">Свернуть</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>