<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sessions\TimePrices */

$this->title = 'Create Time Prices';
$this->params['breadcrumbs'][] = ['label' => 'Time Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
