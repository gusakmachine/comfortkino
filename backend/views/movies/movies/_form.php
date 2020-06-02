<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\ImagesAsset;

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

    <div class="form-group">
        <label class="control-label" for="movies-duration">Актёры</label>
        <?= Html::input('text', 'actors', $actors, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="movies-duration">Режисёры</label>
        <?= Html::input('text', 'directors', $directors, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="movies-duration">Жанры</label>
        <?= Html::input('text', 'genres', $genres, ['class' => 'form-control']) ?>
    </div>
    <div class="form-group">
        <label class="control-label" for="movies-duration">Страны</label>
        <?= Html::input('text', 'countries', $countries, ['class' => 'form-control']) ?>
    </div>

    <?= $form->field($model, 'duration')->label('Продолжительность')->textInput() ?>

    <?= $form->field($model, 'age')->label('Возрастные ограничения')->textInput() ?>

    <?= $form->field($model, 'file_poster')->label('Постер')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-poster']) ?>
    <?php if (isset($model['poster'])): ?>
        <img class="model-poster" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@posters') . $model['poster']; ?>" alt="image" />
    <?php endif; ?>

    <?= $form->field($model, 'file_mob_poster')->label('Мобильный постер')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'model-mob-poster']) ?>
    <?php if (isset($model['mob_poster'])): ?>
        <img class="model-mob-poster" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@mob_posters') . $model['mob_poster']; ?>" alt="image" />
    <?php endif; ?>

    <div class="form-group">
        <?= $form->field($model, 'files_gallery[]')->label('Галерея')->fileInput(['class' => 'false-gallery-input', 'multiple' => 'multiple']) ?>
        <div class="gallery">
        <?php foreach ($gallery_paths as $key => $path): ?>
            <div class="gallery-item">
                <svg class="gallery-delete-icon">
                    <use href="/img/static/icons.svg#cross" ></use>
                </svg>
                <img class="gallery-img" src="<?= Yii::getAlias('@frontend_link'). Yii::getAlias('@gallery') . $path['path']; ?>" data-image-name="<?= $path['path']; ?>" />
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
