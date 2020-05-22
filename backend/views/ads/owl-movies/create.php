<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlMovies */

$this->title = 'Create Owl Movies';
$this->params['breadcrumbs'][] = ['label' => 'Owl Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owl-movies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
