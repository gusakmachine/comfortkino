<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\movies\Actors */

$this->title = 'Create Actors';
$this->params['breadcrumbs'][] = ['label' => 'Actors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
