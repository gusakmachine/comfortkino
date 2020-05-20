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
<header class="header">
    <a href="<?= Url::home()?>"><img src="<?= Yii::getAlias('@logo-image'); ?>" alt="Кинотеатр Русь, логотип" class="header__logo"></a>
    <button class="header__town-link" data-sh="#popup-cities">
        <span class="header__town"><?= Yii::$app->session->get('city') ?></span>
        <svg class="header__arrow-without-bottom"><use href="<?= Yii::getAlias('@svg:#arrow-without-bottom'); ?>"></use></svg>
    </button>
</header>
<div class="page-background" style="background-image: url(<?= Yii::getAlias('@backgrounds') . $this->context->pageBackgroundPath['background_image_name']; ?>)"></div>

<?= $content ?>

<footer class="footer">
    <div class="container">
        <h4 class="footer__title">Контакты</h4>
        <span class="footer__address"><?= $this->context->movieTheater['movie-theater-address']; ?></span>
        <div class="footer__contacts">
            <div class="row">
                <a class="footer__map" href="<?= $this->context->movieTheater['google-map-link'] ?>" target="_blank" style="background-image: url('<?= Yii::getAlias('@map_img') .  $this->context->movieTheater['google-map-img'] ?>')"></a>
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
