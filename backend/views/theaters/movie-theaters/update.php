<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $movieTheaters common\models\theaters\MovieTheaters */

$this->title = 'Update Movie Theaters: ' . $movieTheaters->name;
$this->params['breadcrumbs'][] = ['label' => 'Movie Theaters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $movieTheaters->name, 'url' => ['view', 'id' => $movieTheaters->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="movie-theaters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'movieTheaters' => $movieTheaters,
        'socials' => $socials,
        'phones' => $phones,
        'cities' => $cities,
    ]) ?>

</div>
