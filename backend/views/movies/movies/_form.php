<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\ImagesAsset;
use kartik\select2\Select2;

ImagesAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\movies\Movies */
/* @var $form yii\widgets\ActiveForm */
/* @var $files common\models\UploadForm */
?>

<div class="movies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->label('Название фильма')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->label('Описание')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'actors')->widget(Select2::classname(), [
        'data' => $actors,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ])->label('Актёры');
    ?>
    <?= $form->field($model, 'directors')->widget(Select2::classname(), [
        'data' => $directors,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ])->label('Режисёры');
    ?>
    <?= $form->field($model, 'genres')->widget(Select2::classname(), [
        'data' => $genres,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ])->label('Жанры');
    ?>
    <?= $form->field($model, 'countries')->widget(Select2::classname(), [
        'data' => $countries,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ])->label('Страны');
    ?>

    <?= $form->field($model, 'duration')->label('Продолжительность')->textInput() ?>

    <?= $form->field($model, 'age')->label('Возрастные ограничения')->textInput() ?>

    <?= $form->field($model, 'file_poster')->label('Постер')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-poster']) ?>
    <img class="model-poster" style="display: <?= $model['poster'] ? 'block' : 'none' ?>" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@posters') . '/' . $model['id'] . '/'   . $model['poster']; ?>" alt="image" />


    <?= $form->field($model, 'file_mob_poster')->label('Мобильный постер')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-mob-poster']) ?>
    <img class="model-mob-poster" style="display: <?= $model['mob_poster'] ? 'block' : 'none' ?>" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@mob_posters') . '/' . $model['id'] . '/'   . $model['mob_poster']; ?>" alt="image" />

    <div class="form-group">
        <?= $form->field($model, 'files_gallery[]')->label('Галерея')->fileInput(['class' => 'false-gallery-input', 'multiple' => 'multiple']) ?>
        <div class="gallery">
            <div class="gallery-item" style="display:none;">
                <svg class="gallery-delete-icon">
                    <use href="/img/static/icons.svg#cross" ></use>
                </svg>
                <img class="gallery-img"/>
            </div>
        <?php foreach ($gallery as $key => $gallery_image): ?>
            <div class="gallery-item">
                <svg class="gallery-delete-icon">
                    <use href="/img/static/icons.svg#cross" ></use>
                </svg>
                <img class="gallery-img"
                     src="<?= Yii::getAlias('@frontend_link'). Yii::getAlias('@gallery') . '/' . $model['id'] . '/'  . $gallery_image['image_name']; ?>"
                     data-image-idx="<?= $gallery_image['id']; ?>"
                     data-image-name="<?= $gallery_image['image_name']; ?>"
                />
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <?= $form->field($model, 'trailer')->label('Ссылка на трейлер')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_date')->label('Дата выхода фильма')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
