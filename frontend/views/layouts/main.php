<?php

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\assets\AppAsset;

use frontend\widgets\PopupCities\PopupCities;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>
        var getMoviesURL = '<?= Url::to(['site/movies']) ?>';
        var getTicketsURL = '<?= Url::to(['site/tickets']) ?>';
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= PopupCities::widget() ?>

<div id="popup-tickets" class="popup show-hide"></div>

<div class="page-background" style="background-image: url(img/background/50ee4a7ce72c7426ffe2eff30267411e.jpg)"></div>
<header class="header">
    <a href="<?= Url::home()?>"><img src="<?= Yii::getAlias('@logo-image'); ?>" alt="Кинотеатр Русь, логотип" class="header__logo"></a>
    <button class="header__town-link" data-sh="#popup-cities">
        <span class="header__town"><?= Yii::$app->session->get('city') ?></span>
        <svg class="header__arrow-without-bottom"><use href="<?= Yii::getAlias('@svg:#arrow-without-bottom'); ?>"></use></svg>
    </button>
</header>

<?= $content ?>

<footer class="footer">
    <div class="container">
        <h4 class="footer__title">Контакты</h4>
        <div class="footer__contacts">
            <div class="row">
                <a class="footer__map" href="https://www.google.com/maps/place/%D0%9A%D1%96%D0%BD%D0%BE%D0%BF%D0%B0%D0%BB%D0%B0%D1%86+%D0%A3%D0%BA%D1%80%D0%B0%D1%97%D0%BD%D0%B0/@48.56272,39.3153204,16.92z/data=!4m5!3m4!1s0x0:0x5be417229d8bd3c1!8m2!3d48.5628691!4d39.3164075?hl=ru" target="_blank" style="background-image: url('img/map-place-kinorus.png')"></a>
                <div class="footer__info">
                    <div class="footer__tel">
                        <p><a href="tel:380999323615">+380 (99) 9323615</a></p>
                        <p><a href="tel:380999323615">+380 (99) 9323615</a></p>
                    </div>
                    <div class="footer__socials">
                        <a class="sm--facebook" href="#" target="_blank" rel="nofollow noopener">
                            <span>
                                <svg><use href="/img/static/icons/icons.svg#facebook"></use></svg>
                            </span>
                        </a>
                        <a class="sm--insta" href="#" target="_blank" rel="nofollow noopener">
                            <span>
                                <svg><use href="/img/static/icons/icons.svg#inst"></use></svg>
                            </span>
                        </a>
                        <a class="sm--vk" href="#" target="_blank" rel="nofollow noopener">
                            <span>
                                <svg><use href="/img/static/icons/icons.svg#vk"></use></svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
