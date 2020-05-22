<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlAds */

$this->title = 'Create Owl Ads';
$this->params['breadcrumbs'][] = ['label' => 'Owl Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owl-ads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
