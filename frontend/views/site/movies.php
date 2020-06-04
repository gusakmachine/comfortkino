<?php for ($i = 0; $i < count($sessions); $i++): ?>
    <div class="films-item">
        <div class="wrapper">
            <a href="<?= $movies[$i]['trailer'] ?>" class="film__poster" style="background-image: url(<?= Yii::getAlias('@posters')  . '/' . $movies[$i]['id'] . '/'  . $movies[$i]['poster'] ?>)">
                <div class="film__play-wrapper">
                    <span class="film__play">
                        <svg class="film__play-svg">
                            <use href="<?= Yii::getAlias('@svg:#arrow-filled'); ?>"></use>
                        </svg>
                    </span>
                </div>
            </a>
            <a href="#" class="film__trailer-preview" style="background-image: url(<?= Yii::getAlias('@mob_posters')  . '/' . $movies[$i]['id'] . '/'  .  $movies[$i]['mob_poster'] ?>)">
                <div class="film__play-wrapper">
                    <span class="film__play">
                        <svg class="film__play-svg">
                            <use href="<?= Yii::getAlias('@svg:#arrow-filled'); ?>"></use>
                        </svg>
                    </span>
                </div>
            </a>
        </div>
        <div class="film">
            <div class="top-left-content">
                <div class="left-content">
                    <p class="film__label">
                    <span class="film__country">
                        <?php for($j = 0; $j < count($movies[$i]['countries']); $j++) echo $movies[$i]['countries'][$j]['name'] . ($j + 1 < count($movies[$i]['countries'])? ', ' : ' '); ?>
                    </span>
                    <span class="film__genre">
                        <?php for($j = 0; $j < count($movies[$i]['genres']); $j++) echo $movies[$i]['genres'][$j]['name'] . ($j + 1 < count($movies[$i]['genres'])? ', ' : ' '); ?>
                    </span>
                        <span class="film__duration"><?= $movies[$i]['duration'] ?></span>
                    </p>
                    <a href="<?= \yii\helpers\Url::to(['site/film', 'id' => $movies[$i]['id']]) ?>" class="film__title"><?= $movies[$i]['title'] ?></a>
                </div>
                <span class="film__age-rating"><?= $movies[$i]['age'] ?>+</span>
            </div>
            <div class="flex-wrapper">
                <?php for ($sessions_timeIDX = 0 ; $sessions_timeIDX < count($sessions[$i]['times']); $sessions_timeIDX++): ?>
                    <button class="film__sessions-info" data-SH="#popup-tickets" data-sessionID="<?= $sessions[$i]['id'] ?>" data-timeID="<?= $sessions_timeIDX ?>">
                        <span class="film__session-time session-time"><?= date('H:i', strtotime($sessions[$i]['times'][$sessions_timeIDX]['time'])); ?></span>
                        <span class="film__session-price session-price">от <?= $sessions[$i]['times'][$sessions_timeIDX]['price'] ?> ₽</span>
                    </button>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php endfor;?>
