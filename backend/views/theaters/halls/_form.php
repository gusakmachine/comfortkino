<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\TabularInput;
use backend\assets\PlacesEditorAsset;
use kartik\select2\Select2;

PlacesEditorAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\theaters\Halls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="halls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput()->label('Название зала')  ?>

    <?= $form->field($model, 'capacity')->textInput()->label('Вместимость')  ?>

    <?= $form->field($model, 'movie_theaters_id')->widget(Select2::classname(), [
        'data' => $movie_theaters,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('ID кинотеатра');
    ?>

    <?php if ($this->context->module->requestedAction->id == 'update'): ?>
        <?= $form->field($model, 'places_sets_id')->textInput()->label('ID мест кнозала') ?>
    <?php endif; ?>

    <div class="rows example">
        <p class="row_number"></p>
    </div>
    <div class="places-wrapper example">
        <span class="places">1</span>
        <span class="place-price">100</span>
        <input class="hidden place-price-id">
        <input class="hidden place-color-id">
        <input class="hidden place-graphic-display">
    </div>

    <div class="places-edit-menu">
        <div class="edit-menu__item">
            <div class="edit-menu__option-container">
                <label for="color">Цвета для всех следующих</label>
                <select id="colors" class="colors">
                    <?php foreach ($colors as $item): ?>
                        <option value="<?= $item['id']; ?>" style="background-color: <?= $item['color']; ?>"><?= $item['color']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="edit-menu__option-container">
                <input class="inpt price" placeholder="Цена" value="100">
            </div>
            <span class="span-btn edit_place-price">Изменить выделенные</span>
        </div>
        <div class="edit-menu__item">
            <input class="inpt number_rows" placeholder="Ко-во рядов">
            <input class="inpt number_places" placeholder="Ко-во мест">
            <span class="span-btn edit_rows">Добавить ряды</span>
            <span class="span-btn delete-row">Удалить выделенное</span>
        </div>
        <div class="edit-menu__item">
            <input class="inpt count-places" value="10">
            <span class="span-btn add_places">Добавить места</span>
        </div>
    </div>
    <div class="hall">
        <?php if(isset($places)):?>
            <?php for ($i = 0; $i < count($places); $i++): ?>
                <div class="rows setup" data-row-number="<?= $places[$i]['row']; ?>">
                    <p class="row_number"><?= $places[$i]['row']; ?> ряд</p>
                    <?php for (; $i < count($places); $i++): ?>
                        <div class="places-wrapper">
                            <span class="places" style="background-color: <?= $places[$i]['color']->color; ?>"><?= $places[$i]['place']; ?></span>
                            <span class="place-price"><?= $places[$i]['price']; ?></span>
                            <input class="hidden place-price-id" value="<?= $places[$i]['price']; ?>">
                            <input class="hidden place-color-id" value="<?= $places[$i]['color']->id ?>">
                            <input class="hidden place-graphic-display">
                        </div>
                        <?php
                            if (isset($places[$i + 1]) && $places[$i]['row'] != $places[$i + 1]['row'])
                                break;
                        ?>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
