<div class="popup-tickets__wrapper">
    <div class="popup-content">
        <div id="popupClose" class="popup__close" data-SH="#popup-tickets">
            <svg viewBox="0 0 18 18" width="18" height="18">
                <path d="M15.5 17.6l-6.5-6.5-6.5 6.5c-.6.6-1.5.6-2.1 0-.6-.6-.6-1.5 0-2.1l6.5-6.5-6.5-6.5c-.6-.6-.6-1.5 0-2.1.6-.6 1.5-.6 2.1 0l6.5 6.5 6.5-6.5c.6-.6 1.5-.6 2.1 0 .6.6.6 1.5 0 2.1l-6.5 6.5 6.5 6.5c.6.6.6 1.5 0 2.1-.3.3-.6.4-1 .4s-.8-.2-1.1-.4z"></path>
            </svg>
        </div>
        <div class="popup__header">
            <h3 class="popup__header-title" data-movie-id="<?= $movie['id'] ?>"><?= $movie['title'] ?></h3>
            <div class="popup__header-subtitle">
                <a href="#" class="popup__town-toggler" data-SH="#popup-cities">
                    <span data-cinema-id="<?= $movieTheater['id']; ?>" style="display: none"></span>
                    <span data-city-id="<?= $city['id']; ?>" class="popup__town"><?= Yii::$app->session->get('city') ?></span>
                    <svg class="header__arrow-without-bottom">
                        <use href="<?= Yii::getAlias('@svg:#arrow-without-bottom'); ?>"></use>
                    </svg>
                </a>
                <span data-hall-id="<?= $hall['id'] ?>"><?= $hall['name'] ?></span>
                <span data-time-id="<?= $session['times'][$sessionTimeIDX]['id'] ?>"><?= date('d M Y', strtotime($session['date'])) . ', ' . date('H:i', strtotime($session['times'][$sessionTimeIDX]['time'])); ?></span>
            </div>
        </div>
        <div class="popup__timetable">
            <div class="flex-wrapper">
                <?php for ($i = 0; $i < count($session['times']); $i++): ?>
                    <button class="popup__timetable-link film__sessions-info" data-sessionID="<?= $session['id'] ?>" data-timeID="<?= $i ?>">
                        <span class="popup__timetable-time film__session-time session-time"><?= date('H:i', strtotime($session['times'][$i]['time'])); ?></span>
                        <span class="popup__timetable-price film__session-price session-price rub">от <?= $session['times'][$i]['price'] ?></span>
                    </button>
                <?php endfor; ?>
            </div>
        </div>
        <div class="popup__scheme">
            <div class="popup__scheme-inner dragscroll">
                <div class="scheme">
                    <div class="scheme__header">
                        <?php foreach ($prices as $key => $price): ?>
                            <div class="scheme-ticket">
                                <div class="place scheme-ticket__place" style="background: <?= $colors[$key] ?>"></div>
                                <div class="scheme-ticket__price rub"><?= $price ?></div>
                            </div>
                        <?php endforeach; ?>
                        <div class="scheme-ticket">
                            <div class="place scheme-ticket__place" data-sold="true"></div>
                            <div class="scheme-ticket__price">Место занято</div>
                        </div>
                    </div>
                    <div id="scheme__body" class="scheme__body">
                        <div id="scheme-menu" class="scheme-menu">
                            <?php for($i = 0; $i < count($hall['places']); $i++): ?>
                                <?php if (!isset($hall['places'][$i + 1]['row']) || ($i + 1 < count($hall['places']) && $hall['places'][$i]['row'] != $hall['places'][$i + 1]['row'])): ?>
                                    <span class="place-row" style="left: 0; top: <?=  $hall['places'][$i]['graphic_display']['top'] ?>px;"><?= $hall['places'][$i]['row'] ?></span>
                                    <span class="place-row" style="right: 0; top: <?=  $hall['places'][$i]['graphic_display']['top'] ?>px;"><?= $hall['places'][$i]['row'] ?></span>
                                <?php endif; ?>
                                <button class="place scheme-menu__place" data-place-id="<?= $hall['places'][$i]['id'] ?>" <?= $hall['places'][$i]['isSold'] ? 'data-sold="true"' : ''?> style="<?= $hall['places'][$i]['isSold'] ? '' : 'background: ' . $hall['places'][$i]['color_id']['color'] . ';' ?> left: <?=  $hall['places'][$i]['graphic_display']['left'] ?>px; top: <?=  $hall['places'][$i]['graphic_display']['top'] ?>px;">
                                    <span class="placenumber"><?=  $hall['places'][$i]['place'] ?></span>
                                    <div class="popover">
                                        <span class="big rub"><?= $session['times'][$sessionTimeIDX]['price'] +  $hall['places'][$i]['price_id']['price'] ?></span>
                                        <span><?=  $hall['places'][$i]['row'] . ' ряд, ' .  $hall['places'][$i]['place'] . ' место' ?></span>
                                    </div>
                                </button>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="scheme__controls">
                        <div class="controls">
                            <button id="scheme__control-plus" class="control" type="button">
                                <svg width="14" height="14" viewBox="0 0 14 14">
                                    <path d="M12 5h-3v-3c0-1.1-.9-2-2-2s-2 .9-2 2v3h-3c-1.1 0-2 .9-2 2s.9 2 2 2h3v3c0 1.1.9 2 2 2s2-.9 2-2v-3h3c1.1 0 2-.9 2-2s-.9-2-2-2z"></path>
                                </svg>
                            </button>
                            <button id="scheme__control-minus" class="control" type="button">
                                <svg width="14" height="14" viewBox="0 0 14 14">
                                    <path d="M12 5h-10c-1.1 0-2 .9-2 2s.9 2 2 2h10c1.1 0 2-.9 2-2s-.9-2-2-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup__text">
            <div class="tickets popup__content-tickets">
                <input class="tickets__phone-number" type="text" name="phone_number" maxlength="15" placeholder="Номер телефона">
                <button id="tickets__result" class="tickets__result">Выберите места</button>
                <button class="tickets__btn">Заказать билеты</button>
            </div>
        </div>
    </div>
</div>
