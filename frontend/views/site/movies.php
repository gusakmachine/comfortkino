<?php

use frontend\models\MovieTheater;

$sessions = MovieTheater::getSessions('otrada', $date);
$sessions_time = MovieTheater::getSessionTime($sessions);
$movies = MovieTheater::getMoviesForThisSession($sessions);

$sessions_timeIDX = 0;

?>
<?php for ($i = 0; $i < count($sessions); $i++): ?>
<div class="films-item">
    <div class="wrapper">
        <a class="film__play" href="#">
            <svg class="film__play-svg">
                <use href="<?= Yii::getAlias('@svg:#arrow-filled'); ?>"></use>
            </svg>
        </a>
        <a href="#" class="film__poster" style="background-image: url(img/posters/<?= $movies[$i]['poster'] ?>)"></a>
        <a href="#" class="film__trailer-preview" style="background-image: url(img/mob_poster/<?= $movies[$i]['mob_poster'] ?>)"></a>
    </div>
    <div class="film">
        <div class="top-left-content">
            <div class="left-content">
                <p class="film__label">
                    <span class="film__country">
                        <?php for($j = 0; $j < count($movies[$i]['countries']); $j++) echo $movies[$i]['countries'][$j] . ', '; ?>
                    </span>
                    <span class="film__genre">
                        <?php for($j = 0; $j < count($movies[$i]['genres']); $j++) echo $movies[$i]['genres'][$j] . ', '; ?>
                    </span>
                    <span class="film__duration"><?= $movies[$i]['duration'] ?></span>
                </p>
                <a href="#" class="film__title"><?= $movies[$i]['title'] ?></a>
            </div>
            <span class="film__age-rating"><?= $movies[$i]['age'] ?>+</span>
        </div>
        <div class="flex-wrapper">
            <?php for ( ; $sessions_timeIDX < count($sessions_time); $sessions_timeIDX++): ?>
                <?php if ($sessions_time[$sessions_timeIDX]['id'] != $sessions[$i]['id']) break; ?>
                <button class="film__sessions-info" data-SH="#popup">
                    <span class="film__session-time"><?= date('H:i', strtotime($sessions_time[$sessions_timeIDX]['time'])); ?></span>
                    <span class="film__session-price">от <?= $sessions[$i]['base_price'] ?> ₽</span>
                </button>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php endfor; ?>
