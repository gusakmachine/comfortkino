<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlMovies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="owl-movies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'movie_id')->widget(Select2::classname(), [
        'data' => $movies,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Фильм');
    ?>

    <?= $form->field($model, 'movie_theaters_id')->widget(Select2::classname(), [
            'data' => $movieTheaters,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Кинотеатр');
    ?>

    <?= $form->field($model, 'end_date')->textInput()->label('Дата окончания') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
