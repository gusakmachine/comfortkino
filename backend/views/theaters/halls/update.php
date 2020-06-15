<?php

use common\models\theaters\MovieTheaters;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\Halls */

$this->title = 'Update Halls: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Halls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="halls-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'places' => $places,
        'colors' => $colors,
        'movie_theaters' => $movie_theaters,
    ]) ?>

</div>
