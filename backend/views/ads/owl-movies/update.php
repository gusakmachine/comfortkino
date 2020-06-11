<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlMovies */

$this->title = 'Update Owl Movies: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Owl Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="owl-movies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'movies' => $movies,
        'movieTheaters' => $movieTheaters,
    ]) ?>

</div>
