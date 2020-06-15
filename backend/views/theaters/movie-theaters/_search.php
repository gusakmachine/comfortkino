<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ads\SearchSessions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'address') ?>
    <?= $form->field($model, 'start_work_time') ?>
    <?= $form->field($model, 'end_work_time') ?>
    <?= $form->field($model, 'subdomain_name') ?>
    <?= $form->field($model, 'vk') ?>
    <?= $form->field($model, 'facebook') ?>
    <?= $form->field($model, 'instagram') ?>
    <?= $form->field($model, 'phoneNumbers') ?>
    <?= $form->field($model, 'city') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
