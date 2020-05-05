<div class="info-carousel owl-carousel">
    <?php for ($sessionsIDX = 0; $i < count($movies); $i++): ?>
        <div>
            <div class="owl-item__blurred-img" style="background-image: url(img/mob_poster/<?= $movies[$i]['mob_poster'] ?>)"></div>
            <a href="#" class="owl-item__film-poster" style="background-image: url(img/posters/<?= $movies[$i]['poster'] ?>)"></a>
            <div class="film">
                <a href="#" class="film__details-link">
                    <span class="film__genre"> <?php for($j = 0; $j < count($movies[$i]['genres']); $j++) echo $movies[$i]['genres'][$j]['name'] . ($j + 1 < count($movies[$i]['genres'])? ', ' : ' '); ?></span>
                    <h1 class="film__title"><?= $movies[$i]['title'] ?></h1>
                </a>
                <div class="film__short-info">
                    <a href="<?= $movies[$i]['trailer'] ?>" class="film__trailer">Смотреть трейлер</a>
                    <span class="film__age-rating"><?= $movies[$i]['age'] ?>+</span>
                </div>
                <?php if(isset($sessions[$sessionsIDX])): ?>
                    <h5 class="film__upcoming-sessions">Ближайшие сеансы <?= Yii::$app->formatter->asDate($sessions[$sessionsIDX]['date'], 'dd.MM'); ?>:</h5>
                    <div class="flex-wrapper">
                        <?php for ($k = 0; $k < count($sessions[$sessionsIDX]['time']); $k++): ?>
                            <button class="film__sessions-info" data-SH="#popup">
                                <span class="film__session-time"><?= date('H:i', strtotime($sessions[$sessionsIDX]['time'][$k]['time'])); ?></span>
                                <span class="film__session-price">от <?= $sessions[$sessionsIDX]['timePrices'][$k]['price'] ?> ₽</span>
                            </button>
                        <?php endfor; ?>
                        <?php
                        for ($sessionsIDX++, $sessionsTimeCounter = 0; $sessionsIDX < count($sessions) && $sessions[$sessionsIDX]['movie_id'] == $movies[$i]['id']; $sessionsIDX++)
                            $sessionsTimeCounter += count($sessions[$sessionsIDX]['time']);
                        ?>
                        <?php if ($sessionsTimeCounter > 0): ?>
                            <a href="#" class="film__sessions-info blue">
                                <span class="film__session-time__more">Ещё <?= $sessionsTimeCounter ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <h5 class="film__upcoming-sessions">Дата выхода <?= Yii::$app->formatter->asDate($movies[$i]['release_date'], 'MM.dd'); ?></h5>
                <?php endif; ?>
            </div>
            <div class="owl__progress-bar">
                <div class="owl__progress-indicator"></div>
            </div>
        </div>
    <?php endfor; ?>
</div>