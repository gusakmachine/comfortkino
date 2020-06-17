<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\components\ControllerURLs;

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
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Url::to(['/favicon.ico'])]); ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script>
        var gallery_URL = '<?=  Yii::getAlias('@frontend_link') . Yii::getAlias('@gallery') ?>';
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $logout = Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('Выход', ['class' => 'btn menu-btn'])
            . Html::endForm();
        $menuItems = ControllerURLs::generateMenuItems($this->context->pages);
        $menuItems[] = '
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                  '. Yii::$app->user->identity->username .' 
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    '. (Yii::$app->user->can('CRUDUsersList') ? '<li><a href="'. Url::to(['/user/manage']) .'">Пользователи</a></li>' : '') .' 
                    <li><a href="'. Url::to(['/site/reset-password']) .'">Изменить пароль</a></li>
                    <li class="divider"></li>
                    <li>
                        '. $logout. '
                    </li>
                </ul>
            </li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
