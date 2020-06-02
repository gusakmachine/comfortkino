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

        var staticSvgIconsPATH = '<?= Yii::getAlias('@static_svg_icons'); ?>';
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

<div class="page-background" style="background-image: url(<?= Yii::getAlias('@page-backgrounds') . $this->context->pageBackgroundPath['background_image_name']; ?>)"></div>

<?= $content ?>
<footer class="footer">
    <div class="container">
        <h4 class="footer__title">Контакты</h4>
        <span class="footer__address"><?= $this->context->movieTheater['movie-theater-address']; ?></span>
        <div class="footer__contacts">
            <div class="row">
                <a class="footer__map" href="<?= $this->context->movieTheater['google_map_link'] ?>" target="_blank" style="background-image: url('<?= Yii::getAlias('@map_img') .  $this->context->movieTheater['google_map_img'] ?>')"></a>
                <div class="footer__info">
                    <div class="footer__tel">
                        <?php foreach ($this->context->movieTheater['phones'] as $phone): ?>
                            <p><a href="tel:<?= $phone ?>"><?= $phone ?></a></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="footer__socials">
                        <?php foreach ($this->context->movieTheater['socials'] as $key => $social): ?>
                            <?php if ($social): ?>
                                <a class="sm--<?= Yii::$app->params['movieTheaterSocials'][$key] ?>" href="https://<?= $social ?>" target="_blank" rel="nofollow noopener">
                                    <span>
                                        <svg><use href="<?= Yii::getAlias('@svg:#'. Yii::$app->params['movieTheaterSocials'][$key]); ?>"></use></svg>
                                    </span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
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
