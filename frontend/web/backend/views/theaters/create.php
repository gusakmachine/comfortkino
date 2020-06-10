<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\Halls */

$this->title = 'Create Halls';
$this->params['breadcrumbs'][] = ['label' => 'Halls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="halls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
