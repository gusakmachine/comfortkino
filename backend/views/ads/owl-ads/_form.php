<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\ImagesAsset;

ImagesAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlAds */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="owl-ads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true])->label('Подзаголовок') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?= $form->field($file, 'imageFiles')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-owl-backgrounds'])->label('Фоновое изображение') ?>
    <img class="model-owl-backgrounds <?= (isset($model['background_image_name']))? '' : 'disabled' ?>" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@owl-backgrounds') . $model['background_image_name']; ?>" alt="image" />

    <?= $form->field($model, 'button_text')->textInput(['maxlength' => true])->label('Текст кнопки') ?>

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
