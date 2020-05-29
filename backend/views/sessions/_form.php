<?php

use unclead\multipleinput\TabularInput;
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

    <?= TabularInput::widget([
        'models' => $times,
        'columns' => [
            [
                'name'  => 'time',
                'title' => 'Time',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]
            ],
            [
                'name'  => 'price',
                'title' => 'Price',
            ],
        ],
    ]) ?>

    <?= $form->field($sessions, 'hall_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
