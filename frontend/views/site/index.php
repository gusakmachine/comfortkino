<?php
use frontend\assets\MainAsset;

MainAsset::register($this);
?>
<?php forEach($notes as $note) : ?>
<div id="attention-note" class="attention-note" style="background: <?= $note['background_color']; ?>" data-sh="#attention-note">
    <div class="container">
        <p class="note__txt">
            <img src="<?= Yii::getAlias('@svg') . $note['svg_image_name']; ?>" />
            <?= $note['text']; ?>
        </p>
    </div>
    <button class="note__close" type="button">
        <svg width="20" height="20">
            <use href="<?= Yii::getAlias('@svg:#cross'); ?>"></use>
        </svg>
    </button>
</div>
<?php endforeach; ?>
<div class="info-carousel owl-carousel">
    <?php forEach($owlMovies as $owlMovie) : ?>
    <div>
        <div class="owl-item__blurred-img" style="background-image: url(<?= Yii::getAlias('@mob_posters')  . '/' . $owlMovie['id'] . '/'   . $owlMovie['mob_poster'] ?>)"></div>
        <a href="#" class="owl-item__film-poster" style="background-image: url(<?= Yii::getAlias('@posters')  . '/' . $owlMovie['id'] . '/'    . $owlMovie['poster'] ?>)"></a>
        <div class="film">
            <a href="<?= \yii\helpers\Url::to(['site/film', 'id' => $owlMovie['id']]) ?>" class="film__details-link">
                <span class="film__genre"> <?php for($j = 0; $j < count($owlMovie['genres']); $j++) echo $owlMovie['genres'][$j]['name'] . ($j + 1 < count($owlMovie['genres'])? ', ' : ' '); ?></span>
                <h1 class="film__title"><?= $owlMovie['title'] ?></h1>
            </a>
            <div class="film__short-info">
                <a href="<?= $owlMovie['trailer'] ?>" class="film__trailer btn">Смотреть трейлер</a>
                <span class="film__age-rating"><?= $owlMovie['age'] ?>+</span>
            </div>
            <?php if(isset($owlMovie['sessions'][0])): ?>
                <h5 class="film__upcoming-sessions">Ближайшие сеансы <?= Yii::$app->formatter->asDate($owlMovie['sessions'][0]['date'], 'dd.MM'); ?>:</h5>
                <div class="flex-wrapper">
                    <?php for ($k = 0; $k < count($owlMovie['sessions'][0]['times']); $k++): ?>
                        <button class="film__sessions-info" data-SH="#popup-tickets" data-sessionID="<?= $owlMovie['sessions'][0]['id'] ?>" data-timeID="<?= $k ?>">
                            <span class="film__session-time session-time"><?= date('H:i', strtotime($owlMovie['sessions'][0]['times'][$k]['time'])); ?></span>
                            <span class="film__session-price session-price">от <?= $owlMovie['sessions'][0]['times'][$k]['price'] ?> ₽</span>
                        </button>
                    <?php endfor; ?>
                    <?php if ($owlMovie['counter_time'] > 0): ?>
                        <a href="<?= \yii\helpers\Url::to(['site/film', 'id' => $owlMovie['id']]) ?>" class="film__sessions-info blue">
                            <span class="film__session-time session-time__more">Ещё <?= $owlMovie['counter_time'] ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h5 class="film__upcoming-sessions">Дата выхода <?= Yii::$app->formatter->asDate($owlMovie['release_date'], 'MM.dd'); ?></h5>
            <?php endif; ?>
        </div>
        <div class="owl__progress-bar">
            <div class="owl__progress-indicator"></div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php forEach($owlAds as $owlAd) : ?>
    <div>
        <div class="owl__ad-background" style="background-image: url('<?= Yii::getAlias('@owl-backgrounds') . $owlAd['background_image_name']; ?>')"></div>
        <a href="#" class="owl__ad-link">
            <p class="owl__ad-subtitle"><?= $owlAd['subtitle']; ?></p>
            <h3 class="owl__ad-title"><?= $owlAd['title']; ?></h3>
            <span class="owl__ad-btn btn"><?= $owlAd['button_text']; ?></span>
        </a>
        <div class="owl__progress-bar">
            <div class="owl__progress-indicator"></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php forEach($branding_notes as $branding_note) : ?>
<div class="branding-note">
    <img width="20" height="20" src="<?= Yii::getAlias('@svg') . $branding_note['svg_image_name']; ?>">
    <p class="branding-note__link">
        <?= $branding_note['text']; ?>
        <a href="<?= $branding_note['href']; ?>">
            <?= $branding_note['link_text']; ?>
        </a>
    </p>
</div>
<?php endforeach; ?>
<section class="session-schedule">
    <h1 class="session-schedule__title">Расписание сеансов</h1>
    <div class="pos-relative wrapper">
        <button class="day-list__btn --prev disabled"><svg class="day-list__svg--left"><use href="<?= Yii::getAlias('@svg:#arrow-empty'); ?>"></use></svg></button>
        <div class="day-list-wrapper dragscroll">
            <nav class="day-list tabs__header">
                <?php for ($i = 0; $i < count($dayList['date']); $i++):?>
                    <button class="day <?= $i == 0 ? 'day--active' : '' ?>" type="button" data-date="<?= $dayList['date'][$i]['Y-m-d'] ?>">
                        <span class="day__week <?= $dayList['empty_day'][$i]? '' : 'day--disabled' ?>"><?= $dayList['date'][$i]['day-of-week']?></span>
                        <span class="day__date <?= $dayList['empty_day'][$i]? '' : 'day--disabled' ?>"><?= $dayList['date'][$i]['day'], ' ', $dayList['date'][$i]['month']; ?></span>
                    </button>
                    <?php if(date('w', strtotime('+' . $i . 'day')) == 4):?>
                        <div class="days__etc">
                            <span>...</span>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </nav>
        </div>
        <button class="day-list__btn --next <?= count($dayList['date']) > 9? '' : 'disabled' ?>"><svg class="day-list__svg--right"><use href="<?= Yii::getAlias('@svg:#arrow-empty'); ?>"></use></svg></button>
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
                         style="background-image: url(<?= Yii::getAlias('@posters')  . '/' . $movie['id'] . '/'   . $movie['poster']?>)">
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