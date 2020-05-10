<?php

/* @var $this yii\web\View */

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
            <a class="film__trailer btn" href="<?= $movie['trailer'] ?>">
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
                    <?php for ($sessions_timeIDX = 0 ; $sessions_timeIDX < count($session['time']); $sessions_timeIDX++): ?>
                        <button class="film__sessions-info" data-SH="#popup-tickets" data-sessionID="<?= $session['id'] ?>" data-timeID="<?= $sessions_timeIDX ?>">
                            <span class="film__session-time session-time"><?= date('H:i', strtotime($session['time'][$sessions_timeIDX]['time'])); ?></span>
                            <span class="film__session-price session-price">от <?= $session['timePrices'][$sessions_timeIDX]['price'] ?> ₽</span>
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
            </div>
            <div class="film-gallery__bottom-content owl-carousel">
                <?php for ($i = 0; $i < count($movie['galleries']); $i++): ?>
                    <?php switch ($i):
                        case 0: ?>
                            <div class="film-gallery__item">
                                <a href="<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>" class="film-gallery__big-image" style="background-image: url('<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>')"></a>
                                <div class="wrap">
                                    <?php for($i = 1; $i < count($movie['galleries']); $i++): ?>
                                        <a href="<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>" class="film-gallery__middle-image" style="background-image: url('<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>')"></a>
                                        <?php if ($i == 2) break; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php break; ?>
                        <?php default: ?>
                            <div class="film-gallery__item">
                                <?php for ($k = 1; $i < (count($movie['galleries'])); $i++, $k++): ?>
                                    <a href="<?= Yii::getAlias('@gallery') . $movie['galleries'][$i]['path'] ?>" class="film-gallery__middle-image" style="background-image: url('<?= Yii::getAlias('@gallery') .  $movie['galleries'][$i]['path'] ?>')"></a>
                                    <?php if ($k == 3) break; ?>
                                <?php endfor; ?>
                            </div>
                        <?php endswitch; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>