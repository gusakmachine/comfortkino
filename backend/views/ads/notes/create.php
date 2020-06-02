<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\Notes */
/* @var $svg_model common\models\img\SvgIcons */

$this->title = 'Create Notes';
$this->params['breadcrumbs'][] = ['label' => 'Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'svg_model' => $svg_model,
    ]) ?>

</div>
