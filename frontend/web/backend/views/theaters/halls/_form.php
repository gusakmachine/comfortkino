<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\Halls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="halls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'movie_theaters_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
