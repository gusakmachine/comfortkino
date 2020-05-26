<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\SvgIconsViewer\SvgIconsViewer;
/* @var $this yii\web\View */
/* @var $model common\models\ads\BrandingNotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branding-notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'svg_image_name')->textInput(['maxlength' => true, 'id' => 'svg_image_name', 'type' => 'hidden']) ?>
    <?= SvgIconsViewer::widget(['name' => $model['svg_image_name'] , 'element_name' => '#svg_image_name']); ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'movie_theaters_id')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
