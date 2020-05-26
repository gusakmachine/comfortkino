<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\SvgIconsViewer\SvgIconsViewer;
use backend\widgets\AllowedBackgroundColorsViewer\AllowedBackgroundColorsViewer;
/* @var $this yii\web\View */
/* @var $model common\models\ads\Notes */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'svg_image_name')->textInput(['maxlength' => true, 'id' => 'svg_image_name', 'type' => 'hidden']) ?>
    <?= SvgIconsViewer::widget(['name' => $model['svg_image_name'] , 'element_name' => '#svg_image_name']); ?>

    <?= $form->field($model, 'background_color')->textInput(['maxlength' => true, 'id' => 'allowed_background_color_name', 'type' => 'hidden']) ?>
    <?= AllowedBackgroundColorsViewer::widget(['name' => $model['background_color'], 'element_name' => '#allowed_background_color_name']); ?>

    <?= $form->field($model, 'movie_theaters_id')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
