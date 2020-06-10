<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\Images\Images;
/* @var $this yii\web\View */
/* @var $model common\models\ads\BrandingNotes */
/* @var $svg_model common\models\img\SvgIcons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branding-notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true])->label('Текст') ?>

    <?= $form->field($model, 'link_text')->textInput(['maxlength' => true])->label('Текст-ссылка') ?>

    <?= $form->field($model, 'svg_image_name')->textInput(['maxlength' => true, 'id' => 'svg_image_input_id', 'type' => 'hidden'])->label('Значок') ?>
    <?= Images::widget([
            'name' => $model['svg_image_name'],
            'input_id' => '#svg_image_input_id',
            'model' => $svg_model,
            'images_path' => Yii::getAlias('@frontend_link') . Yii::getAlias('@svg')
        ]); ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true])->label('Ссылка') ?>

    <?= $form->field($model, 'movie_theaters_id')->textInput()->label('ID кинотеатра') ?>

    <?= $form->field($model, 'end_date')->textInput()->label('Дата окончания') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
