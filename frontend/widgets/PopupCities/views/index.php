<?php
$cities = Yii::$app->cityComponent->getCities();
?>
<div id="popup-cities" class="popup-cities" style="display: none;">
    <div class="popup-cities__top-content">
        <button class="popup-cities__close-btn" data-sh="#popup-cities"><svg class="popup-cities__close-svg"><use href="<?= Yii::getAlias('@svg:#cross'); ?>"></use></svg></button>
    </div>
    <div class="popup-cities__bottom-content tabs">
        <div class="popup-cities__cities tabs__header">
            <?php foreach ($cities as $key => $item): ?>
                <button class="popup-cities__city <?= Yii::$app->session->get('city') == $item['name'] ? 'active' : ''?>" data-idx="<?= $key ?>"><?= $item['name'] ?></button>
            <?php endforeach; ?>
        </div>
        <div class="tabs__body">
            <?php foreach ($cities as $city): ?>
                <div class="popup-cities__addresses tabs__content ">
                    <?php foreach (Yii::$app->cityComponent->getMovieTheaterByCityId($city['id']) as $theater): ?>
                        <a href="<?= '//' . $theater['subdomain_name'] . '.' . Yii::$app->params['HostName']; ?>" class="popup-cities__address">
                            <svg><use href="<?= Yii::getAlias('@svg:place-logos'); ?>"></use></svg>
                            <span><?= $theater['address'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>