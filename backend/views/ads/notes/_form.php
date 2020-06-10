<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\Images\Images;
use backend\widgets\AllowedBackgroundColorsViewer\AllowedBackgroundColorsViewer;


/* @var $this yii\web\View */
/* @var $model common\models\ads\Notes */
/* @var $svg_model common\models\img\SvgIcons */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true])->label('Текст') ?>

    <?= $form->field($model, 'svg_image_name')->textInput(['maxlength' => true, 'id' => 'svg_image_input_id', 'type' => 'hidden'])->label('Значок') ?>
    <?= Images::widget([
        'name' => $model['svg_image_name'],
        'input_id' => '#svg_image_input_id',
        'model' => $svg_model,
        'images_path' => Yii::getAlias('@frontend_link') . Yii::getAlias('@svg')
    ]); ?>

    <?= $form->field($model, 'background_color')->textInput(['maxlength' => true, 'id' => 'allowed_background_color_input_id', 'type' => 'hidden'])->label('Цвет фона') ?>
    <?= AllowedBackgroundColorsViewer::widget([
            'current_color' => $model['background_color'],
            'input_id' => 'allowed_background_color_input_id',
        ]);
    ?>

    <?= $form->field($model, 'movie_theaters_id')->textInput()->label('ID кинотеатра') ?>

    <?= $form->field($model, 'end_date')->textInput()->label('Дата окончания') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
