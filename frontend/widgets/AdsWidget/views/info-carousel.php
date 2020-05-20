<div class="info-carousel owl-carousel">
    <?php for ( ; $startIDX < $endIDX; $startIDX++): ?>
        <?php if (isset($ads[$startIDX]['json_content']['movie_id'])): ?>
            <div>
                <div class="owl-item__blurred-img" style="background-image: url(<?= Yii::getAlias('@mob_posters') . $ads[$startIDX]['movie']['mob_poster'] ?>)"></div>
                <a href="#" class="owl-item__film-poster" style="background-image: url(<?= Yii::getAlias('@posters') . $ads[$startIDX]['movie']['poster'] ?>)"></a>
                <div class="film">
                    <a href="<?= \yii\helpers\Url::to(['site/film', 'id' => $ads[$startIDX]['movie']['id']]) ?>" class="film__details-link">
                        <span class="film__genre"> <?php for($j = 0; $j < count($ads[$startIDX]['movie']['genres']); $j++) echo $ads[$startIDX]['movie']['genres'][$j]['name'] . ($j + 1 < count($ads[$startIDX]['movie']['genres'])? ', ' : ' '); ?></span>
                        <h1 class="film__title"><?= $ads[$startIDX]['movie']['title'] ?></h1>
                    </a>
                    <div class="film__short-info">
                        <a href="<?= $ads[$startIDX]['movie']['trailer'] ?>" class="film__trailer btn">Смотреть трейлер</a>
                        <span class="film__age-rating"><?= $ads[$startIDX]['movie']['age'] ?>+</span>
                    </div>
                    <?php if(isset($ads[$startIDX]['sessions'][0])): ?>
                        <h5 class="film__upcoming-sessions">Ближайшие сеансы <?= Yii::$app->formatter->asDate($ads[$startIDX]['sessions'][0]['date'], 'dd.MM'); ?>:</h5>
                        <div class="flex-wrapper">
                            <?php $maxCountTimesInOwl = count($ads[$startIDX]['sessions'][0]['time']) > 4 ? 4 : count($ads[$startIDX]['sessions'][0]['time'])?>
                            <?php for ($k = 0; $k < $maxCountTimesInOwl; $k++): ?>
                                <button class="film__sessions-info" data-SH="#popup">
                                    <span class="film__session-time session-time"><?= date('H:i', strtotime($ads[$startIDX]['sessions'][0]['time'][$k]['time'])); ?></span>
                                    <span class="film__session-price session-price">от <?= $ads[$startIDX]['sessions'][0]['timePrices'][$k]['price'] ?> ₽</span>
                                </button>
                            <?php endfor; ?>
                            <?php if ($ads[$startIDX]['counter_time'] > $maxCountTimesInOwl): ?>
                                <a href="<?= \yii\helpers\Url::to(['site/film', 'id' => $ads[$startIDX]['movie']['id']]) ?>" class="film__sessions-info blue">
                                    <span class="film__session-time session-time__more">Ещё <?= ($ads[$startIDX]['counter_time'] - $maxCountTimesInOwl) ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <h5 class="film__upcoming-sessions">Дата выхода <?= Yii::$app->formatter->asDate($ads[$startIDX]['movie']['release_date'], 'MM.dd'); ?></h5>
                    <?php endif; ?>
                </div>
                <div class="owl__progress-bar">
                    <div class="owl__progress-indicator"></div>
                </div>
            </div>
        <?php else: ?>
            <div>
                <div class="owl__ad-background" style="background-image: url('/img/ads/<?= $ads[$startIDX]['json_content']['owl__ad-background']; ?>')"></div>
                <a href="#" class="owl__ad-link">
                    <p class="owl__ad-subtitle"><?= $ads[$startIDX]['json_content']['owl__ad-subtitle']; ?></p>
                    <h3 class="owl__ad-title"><?= $ads[$startIDX]['json_content']['owl__ad-title']; ?></h3>
                    <span class="owl__ad-btn btn">Подробнее</span>
                </a>
                <div class="owl__progress-bar">
                    <div class="owl__progress-indicator"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endfor; ?>
</div>