<?php

/* @var $this yii\web\View */

use frontend\components\MovieTheater;
use \yii\helpers\Url;
use frontend\assets\FilmAsset;

$this->title = 'Фильм «' . $movie['title'] . '» — Мягкий кинотеатр ' . Yii::$app->session->get('theaterName');

FilmAsset::register($this);
?>
<section class="main-film">
    <a href="<?= Yii::getAlias('@posters') . $movie['poster'] ?>" class="film__poster" style="background-image: url(<?= Yii::getAlias('@posters') . $movie['poster'] ?>)"></a>
    <a href="<?= Yii::getAlias('@mob_posters') . $movie['mob_poster'] ?>" class="film__trailer-preview" style="background-image: url(<?= Yii::getAlias('@mob_posters') . $movie['mob_poster'] ?>)">
        <div class="film__play">
            <svg class="film__play-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
            </svg>
        </div>
    </a>
    <div class="film partially-hidden-content max-height-on">
        <div class="film__top-left-content">
            <div class="film__left-content">
                <p class="film__label">
                    <span class="film__country">
                        <?php for($j = 0; $j < count($movie['countries']); $j++) echo $movie['countries'][$j]['name'] . ($j + 1 < count($movie['countries'])? ', ' : ' '); ?>
                    </span>
                    <span class="film__genre">
                        <?php for($j = 0; $j < count($movie['genres']); $j++) echo $movie['genres'][$j]['name'] . ($j + 1 < count($movie['genres'])? ', ' : ' '); ?>
                    </span>
                    <span class="film__duration"><?= $movie['duration'] ?></span>
                </p>
                <h1 class="film__title"><?= $movie['title'] ?></h1>
            </div>
            <a class="film__trailer" href="<?= $movie['trailer'] ?>">
                <span class="film__trailer-title">Трейлер</span>
                <svg class="film__trailer-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="white">
                    <path d="M9.4 6l-7.7 3.9c-.4.2-.8.2-1.2 0-.3-.3-.5-.6-.5-1v-7.8c0-.4.2-.8.6-1 .4-.2.8-.2 1.2 0l7.6 3.9c.6.3.8.9.5 1.5-.1.2-.3.4-.5.5z"></path>
                </svg>
            </a>
        </div>
        <p class="film__description"><?= $movie['description'] ?></p>
            <?php foreach ($sessions as $key => $session): ?>
                <span class="film__day-name"><?= $dayList[$key]['day-of-week'] ?></span>
                <div class="flex-wrapper">
                    <?php for ($i = 0 ; $i < count($session['time']); $i++): ?>
                        <button class="film__sessions-info" data-SH="#popup">
                            <span class="film__session-time"><?= date('H:i', strtotime($session['time'][$i]['time'])); ?></span>
                            <span class="film__session-price">от <?= $session['base_price'] ?> ₽</span>
                        </button>
                    <?php endfor; ?>
                </div>
            <?php endforeach; ?>
        <button class="film__show-all-sessions-btn">Еще сеансы</button>
    </div>
</section>
<section class="additionally-film">
    <div class="container">
        <div class="film-about">
            <h3 class="film-about__director">Режиссёр</h3>
            <p class="film-about__directors-names">
                <?php for($j = 0; $j < count($movie['directors']); $j++) echo $movie['directors'][$j]['name'] . ($j + 1 < count($movie['directors'])? ', ' : ' '); ?>
            </p>
            <h3 class="film-about__genre">Жанр</h3>
            <p class="film-about__genre-names">
                <?php for($j = 0; $j < count($movie['genres']); $j++) echo $movie['genres'][$j]['name'] . ($j + 1 < count($movie['genres'])? ', ' : ' '); ?>
            </p>
            <h3 class="film-about__actors">Актёры</h3>
            <p class="film-about__actors-names">
                <?php for($j = 0; $j < count($movie['actors']); $j++) echo $movie['actors'][$j]['name'] . ($j + 1 < count($movie['actors'])? ', ' : ' '); ?>
            </p>
            <h3 class="film-about__description">Описание</h3>
            <p class="film-description-mobile"><?= $movie['description'] ?></p>
        </div>
        <div class="film-gallery">
            <div class="film-gallery__top-content">
                <h1 class="film-gallery__film-frames">Кадры из фильма</h1>
                <div class="film-gallery__buttons">
                    <button class="film-gallery__btn --prev">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 23" fill="#30a6f1">
                            <path d="M16.5 23c-.6 0-1.2-.2-1.7-.5l-13-7.7c-.9-.6-1.5-1.5-1.7-2.6-.2-1 0-2.1.6-3 .3-.3.8-.8 1.1-1l13-7.7c1.1-.7 2.5-.6 3.6.1 1 .8 1.6 1.9 1.6 3.2v15.4c0 1.2-.6 2.4-1.6 3.2-.6.4-1.2.6-1.9.6zm-13.1-12.2l-.2.2c-.2.2-.2.5-.2.7s.2.5.4.6l12.9 7.7c.1.1.2.1.3 0 .2-.2.3-.4.3-.7v-15.5c0-.3-.1-.6-.4-.7.1-.1-.1-.1-.2-.1l-12.9 7.8z"></path>
                        </svg>
                    </button>
                    <button class="film-gallery__btn --next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 23" fill="#30a6f1">
                            <path d="M16.5 23c-.6 0-1.2-.2-1.7-.5l-13-7.7c-.9-.6-1.5-1.5-1.7-2.6-.2-1 0-2.1.6-3 .3-.3.8-.8 1.1-1l13-7.7c1.1-.7 2.5-.6 3.6.1 1 .8 1.6 1.9 1.6 3.2v15.4c0 1.2-.6 2.4-1.6 3.2-.6.4-1.2.6-1.9.6zm-13.1-12.2l-.2.2c-.2.2-.2.5-.2.7s.2.5.4.6l12.9 7.7c.1.1.2.1.3 0 .2-.2.3-.4.3-.7v-15.5c0-.3-.1-.6-.4-.7.1-.1-.1-.1-.2-.1l-12.9 7.8z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="film-gallery__bottom-content dragscroll">
                <?php for ($i = 0; $i < count($movie['galleries']); $i++): ?>
                    <?php switch ($i):
                        case 0: ?>
                            <a href="<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>" class="film-gallery__big-image" style="background-image: url('<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>')"></a>
                            <?php break; ?>
                        <?php case 1: ?>
                            <div class="wrap">
                                <?php for($j = $i; $j < (count($movie['galleries']) > 3 ? 3 : count($movie['galleries'])); $j++): ?>
                                    <a href="<?= Yii::getAlias('@gallery') . $movie['galleries'][$j]['path'] ?>" class="film-gallery__middle-image" style="background-image: url('<?= Yii::getAlias('@gallery') .  $movie['galleries'][$j]['path'] ?>')"></a>
                                <?php endfor; ?>
                            </div>
                            <?php break; ?>
                        <?php case 2: break;?>
                        <?php default: ?>
                            <a href="<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>" class="film-gallery__middle-image" style="background-image: url('<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>')"></a>
                    <?php endswitch; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>