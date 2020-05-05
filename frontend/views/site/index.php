<?php
use frontend\assets\MainAsset;

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
    <div class="pos-relative wrapper">
        <button class="day-list__btn --prev disabled"><svg class="day-list__svg--left"><use href="/img/static/icons/icons.svg#arrow-empty"></use></svg></button>
        <div class="day-list-wrapper dragscroll">
            <nav class="day-list tabs__header">
                <?php for ($i = 0; $i < $length + $endDayListIDX; $i++):?>
                    <button class="day <?= $i == 0 ? 'day--active' : '' ?>" type="button" data-date="<?= date("Y-m-d", strtotime("+" . $i . " day")) ?>">
                        <span class="day__week <?= $i > $length ? 'day--disabled' : '' ?>"><?= $dayList[$i]['day-of-week']?></span>
                        <span class="day__date <?= $i > $length ? 'day--disabled' : '' ?>"><?= $dayList[$i]['day'], ' ', $dayList[$i]['month']; ?></span>
                    </button>
                    <?php if(date('w', strtotime('+' . $i . 'day')) == 4):?>
                        <div class="days__etc">
                            <span>...</span>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </nav>
        </div>
        <button class="day-list__btn --next"><svg class="day-list__svg--right"><use href="/img/static/icons/icons.svg#arrow-empty"></use></svg></button>
    </div>
    <div class="films"></div>
</section>
<?php if ($futureMovies): ?>
<section class="session-soon">
    <div class="container">
        <h2 class="session-soon__title">Скоро</h2>
        <div id="posters" class="posters posters--collapse session-soon__posters">
            <div class="posters__list">
                <?php foreach ($futureMovies as $movie): ?>
                    <div class="poster posters__item"
                         style="background-image: url(<?= Yii::getAlias('@posters') . $movie['poster']?>)">
                        <a href="<?= \yii\helpers\Url::to(['site/film', 'id' => $movie['id']]) ?>" class="poster__link">
                            <span class="poster__age"><?= $movie['age'] ?>+</span>
                            <div class="poster__content">
                                <div>
                                    <h5 class="poster__heading"><?= $movie['title'] ?></h5>
                                    <p class="poster__text"><?php for($j = 0; $j < count($movie['genres']); $j++) echo $movie['genres'][$j]['name'] . ($j + 1 < count($movie['genres'])? ', ' : ' '); ?></p>
                                </div>
                            </div>
                            <div class="poster__date"><?= date('d.m', strtotime($movie['release_date'])) ?></div>
                        </a>
                    </div>
                <?php endforeach; ?>
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

<?php endif; ?>