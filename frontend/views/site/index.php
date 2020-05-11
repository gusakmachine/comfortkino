<?php
use frontend\assets\MainAsset;

MainAsset::register($this);
?>
<section class="session-schedule">
    <h1 class="session-schedule__title">Расписание сеансов</h1>
    <div class="pos-relative wrapper">
        <button class="day-list__btn --prev disabled"><svg class="day-list__svg--left"><use href="/img/static/icons/icons.svg#arrow-empty"></use></svg></button>
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
        <button class="day-list__btn --next <?= count($dayList['date']) > 9? '' : 'disabled' ?>"><svg class="day-list__svg--right"><use href="/img/static/icons/icons.svg#arrow-empty"></use></svg></button>
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