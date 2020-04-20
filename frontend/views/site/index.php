<?php

/* @var $this yii\web\View */
use \yii\helpers\Url;
use frontend\assets\MainAsset;

$this->title = 'My Yii Application';

MainAsset::register($this);

$days = [];

for ($i = 0; $i < 15; $i++) {
    $day = mktime(0, 0, 0, 0, date('d') + $i, 0);
    $day_of_week = Yii::$app->formatter->asDate($day, 'eeee');
    $days[$i] = [
        'day-of-week' => mb_strtoupper(mb_substr($day_of_week, 0, 1, 'utf-8'), 'utf-8') . mb_substr($day_of_week, 1, strlen($day_of_week), 'utf-8'),
        'month' => Yii::$app->formatter->asDate(date('F'), 'MMMM'),
        'day' => Yii::$app->formatter->asDate($day, 'd'),
    ];
}
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
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
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
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time">17:00</span>
                    <span class="film__session-price">от 380 ₽</span>
                </button>
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
            <button class="day-list__btn --prev disabled"><svg class="day-list__svg--left"><use href="/img/static/icons/icons.svg#arrow-empty" /></use></svg></button>
            <div class="day-list-wrapper dragscroll">
                <nav class="day-list tabs__header">
                    <button class="day day--active tabs__link" type="button" data-idx="0">
                        <span class="day__week">Сегодня</span>
                        <span class="day__date"><?= $days[0]['day'], ' ', $days[0]['month']; ?></span>
                    </button>
                    <button class="day tabs__link" type="button" data-idx="0">
                        <span class="day__week">Завтра</span>
                        <span class="day__date"><?= $days[1]['day'], ' ', $days[1]['month']; ?></span>
                    </button>
                    <?php for ($i = 2; $i < count($days); $i++):?>
                        <button class="day <?= ($i == 0)? 'day--active' : '' ?> tabs__link" type="button" data-idx="0">
                            <span class="day__week"><?= $days[$i]['day-of-week']?></span>
                            <span class="day__date"><?= $days[$i]['day'], ' ', $days[$i]['month']; ?></span>
                        </button>
                        <?php if(date('w') + $i == 4):?>
                            <div class="days__etc">
                                <span>...</span>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </nav>
            </div>
            <button class="day-list__btn --next"><svg class="day-list__svg--right"><use href="/img/static/icons/icons.svg#arrow-empty" /></use></svg></button>
        </div>
        <div class="films tabs__body">
            <div class="tabs__content tabs__content--active">
                <div class="films-item">
                    <div class="wrapper">
                        <a class="film__play" href="#">
                            <svg class="film__play-svg">
                                <use href="<?= Yii::getAlias('@svg:#arrow-filled'); ?>"></use>
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
                            <button class="film__sessions-info" data-SH="#popup">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </button>
                            <button class="film__sessions-info" data-SH="#popup">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </button>
                            <button class="film__sessions-info" data-SH="#popup">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </button>
                            <button class="film__sessions-info" data-SH="#popup">
                                <span class="film__session-time">17:00</span>
                                <span class="film__session-price">от 380 ₽</span>
                            </button>
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