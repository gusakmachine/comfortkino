<?php
use frontend\assets\MainAsset;

use frontend\widgets\AdsWidget\AdsWidget;

MainAsset::register($this);
?>
<?= AdsWidget::widget(); ?>
<section class="session-schedule">
    <h1 class="session-schedule__title">Расписание сеансов</h1>
    <div class="pos-relative wrapper">
        <button class="day-list__btn --prev disabled"><svg class="day-list__svg--left"><use href="/img/static/icons/icons.svg#arrow-empty" /></use></svg></button>
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
        <button class="day-list__btn --next"><svg class="day-list__svg--right"><use href="/img/static/icons/icons.svg#arrow-empty" /></use></svg></button>
    </div>
    <div class="films"></div>
</section>
<section class="session-soon">
    <div class="container">
        <h2 class="session-soon__title">Скоро</h2>
        <div id="posters" class="posters posters--collapse session-soon__posters">
            <div class="posters__list">
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
                <div class="poster posters__item"
                     style="background-image: url(img/posters/1d5491e6b2e4107880accec6815b4f29.jpg)">
                    <a href="#" class="poster__link">
                        <span class="poster__age">18+</span>
                        <div class="poster__content">
                            <div>
                                <h5 class="poster__heading">Чёрная Вдова</h5>
                                <p class="poster__text">боевик, приключения</p>
                            </div>
                        </div>
                        <div class="poster__date">
                            30.04
                        </div>
                    </a>
                </div>
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