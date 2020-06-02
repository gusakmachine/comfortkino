<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\BrandingNotes */
/* @var $svg_model common\models\img\SvgIcons */

$this->title = 'Update Branding Notes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Branding Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branding-notes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'svg_model' => $svg_model
    ]) ?>

</div>
