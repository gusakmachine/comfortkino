<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\ImagesAsset;

ImagesAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\ads\PageBackground */
/* @var $file common\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-background-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($file, 'imageFiles')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-page-background']) ?>
    <?php if (isset($model['background_image_name'])): ?>
        <img class="model-page-background" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@page-backgrounds') . $model['background_image_name']; ?>" alt="page_background_image"/>
    <?php endif; ?>

    <?= $form->field($model, 'movie_theaters_id')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
