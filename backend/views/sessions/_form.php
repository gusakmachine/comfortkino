<?php

use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $sessions common\models\sessions\Sessions */
/* @var $movies common\models\sessions\Sessions */
/* @var $times common\models\sessions\Sessions */
/* @var $halls common\models\sessions\Sessions */
/* @var array $time common\models\sessions\Sessions */
/* @var array $timePrice common\models\sessions\Sessions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($sessions, 'date')->textInput()->label('Дата') ?>

    <?= $form->field($sessions, 'movie_id')->widget(Select2::classname(), [
            'data' => $movies,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Фильм');
    ?>


    <?= TabularInput::widget([
        'models' => $times,
        'columns' => [
            [
                'name'  => 'time',
                'title' => 'Время',
                'type'  => \kartik\time\TimePicker::className(),
                'defaultValue' => '12:00:00',
                'options' => [
                    'pluginOptions' => [
                        'showSeconds' => true,
                        'showMeridian' => false,
                        'minuteStep' => 1,
                        'secondStep' => 5,
                    ]
                ]
            ],
            [
                'name'  => 'price',
                'title' => 'Цена',
            ],
        ],
    ]) ?>

    <?= $form->field($sessions, 'hall_id')->widget(Select2::classname(), [
        'data' => $halls,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Зал');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
