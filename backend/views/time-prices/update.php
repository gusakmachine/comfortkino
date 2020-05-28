<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sessions\TimePrices */

$this->title = 'Update Time Prices: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Time Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="time-prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
