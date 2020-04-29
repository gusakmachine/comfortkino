<?php

use frontend\models\Movie;

$data = Movie::getMoviesForThisDate($date);

?>
<?php foreach ($data as $film): ?>
<div class="films-item">
    <div class="wrapper">
        <a class="film__play" href="#">
            <svg class="film__play-svg">
                <use href="<?= Yii::getAlias('@svg:#arrow-filled'); ?>"></use>
            </svg>
        </a>
        <a href="#" class="film__poster" style="background-image: url(img/posters/<?= $film['poster'] ?>)"></a>
        <a href="#" class="film__trailer-preview" style="background-image: url(img/mob_poster/<?= $film['mob_poster'] ?>)"></a>
    </div>
    <div class="film">
        <div class="top-left-content">
            <div class="left-content">
                <p class="film__label">
                    <span class="film__country">Страна 1, Страна 2</span>
                    <span class="film__genre"></span>
                    <span class="film__duration"><?= $film['duration'] ?></span>
                </p>
                <a href="#" class="film__title"><?= $film['title'] ?></a>
            </div>
            <span class="film__age-rating"><?= $film['age'] ?>+</span>
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
<?php endforeach; ?>
