<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\MovieTheaters */

$this->title = 'Create Movie Theaters';
$this->params['breadcrumbs'][] = ['label' => 'Movie Theaters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movie-theaters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'movieTheaters' => $movieTheaters,
        'socials' => $socials,
        'phones' => $phones,
        'cities' => $cities,
    ]) ?>

</div>
