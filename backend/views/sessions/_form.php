<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $sessions common\models\sessions\Sessions */
/* @var $sessionsTime common\models\sessions\Sessions */
/* @var $sessionsTimePrices common\models\sessions\Sessions */
/* @var array $time common\models\sessions\Sessions */
/* @var array $timePrice common\models\sessions\Sessions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($sessions, 'date')->textInput() ?>

    <?= $form->field($sessions, 'movie_id')->textInput() ?>

    <?= $form->field($sessionsTime, 'time_id')->checkboxList(ArrayHelper::map($time, 'id', 'time'))->label('Выберите время сеанса'); ?>

    <?= $form->field($sessionsTimePrices, 'time_prices_id')->checkboxList(ArrayHelper::map($timePrice, 'id', 'price'))->label('Выберите цены сеанса'); ?>

    <?= $form->field($sessions, 'hall_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
