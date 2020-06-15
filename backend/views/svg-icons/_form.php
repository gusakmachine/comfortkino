<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\ImagesAsset;

ImagesAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\SvgIcons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="svg-icons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($file, 'imageFiles')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-poster'])->label('Значок') ?>
    <img class="model-poster <?= (isset($model['name']))? '' : 'disabled' ?>" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@svg') . $model['name']; ?>" alt="image" />

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
