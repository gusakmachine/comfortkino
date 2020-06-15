<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SvgIcons */

$this->title = 'Update Svg Icons: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Svg Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="svg-icons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'file' => $file,
    ]) ?>

</div>
