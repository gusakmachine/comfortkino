<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\PlacePrices */

$this->title = 'Create Place Prices';
$this->params['breadcrumbs'][] = ['label' => 'Place Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
