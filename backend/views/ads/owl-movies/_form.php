<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlMovies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="owl-movies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'movie_id')->textInput() ?>
    <a class="owl-movies__select-movie" href="<?= Url::toRoute(['movies/movies']); ?>">Select movie</a>

    <?= $form->field($model, 'movie_theaters_id')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
