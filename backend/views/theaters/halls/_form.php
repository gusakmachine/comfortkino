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
        <div class="places-wrapper">
            <span class="places">1</span>
            <span class="place-price">100</span>
            <input class="hidden place-price-id">
            <input class="hidden place-color-id">
            <input class="hidden place-graphic-display">
        </div>
        <div class="places-edit-menu">
            <input class="inpt change-count number_places" value="10">
            <span class="span-btn change-count-places">Изменить ко-во мест</span>
            <span class="span-btn delete-row">Удалить ряд</span>
        </div>
    </div>

    <div class="hall">
        <div class="rows-edit-menu">
            <input class="inpt number_rows" value="1">
            <input class="inpt number_places" value="10">
            <span class="span-btn edit_rows">Добавить ряды</span>
        </div>
        <div class="price-edit-menu">
            <input class="inpt start_row" placeholder="Начальный ряд">
            <input class="inpt end_row" placeholder="Конечный ряд">
            <input class="inpt start_place" placeholder="Начальное место">
            <input class="inpt end_place" placeholder="Конечное место">
            <select class="price">
                <?php foreach ($places_prices as $item): ?>
                    <option value="<?= $item['id']; ?>"><?= $item['price']; ?></option>
                <?php endforeach; ?>
            </select>
            <select class="colors">
                <?php foreach ($colors as $item): ?>
                    <option value="<?= $item['id']; ?>" style="background-color: <?= $item['color']; ?>"><?= $item['color']; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="span-btn edit_place-price">Изменить цену</span>
        </div>
        <?php if(isset($places)):?>
            <?php for ($i = 0; $i < count($places); $i++): ?>
                <div class="rows setup" data-row-number="<?= $places[$i]['row']; ?>">
                    <p class="row_number"><?= $places[$i]['row']; ?> ряд</p>
                    <?php for (; $i < count($places); $i++): ?>
                        <div class="places-wrapper">
                            <span class="places" style="background-color: <?= $places[$i]['color_id']->color; ?>"><?= $places[$i]['place']; ?></span>
                            <span class="place-price"><?= $places[$i]['price_id']->price; ?></span>
                            <input class="hidden place-price-id" value="<?= $places[$i]['price_id']->id ?>">
                            <input class="hidden place-color-id" value="<?= $places[$i]['color_id']->id ?>">
                            <input class="hidden place-graphic-display">
                        </div>
                        <?php
                            if (isset($places[$i + 1]) && $places[$i]['row'] != $places[$i + 1]['row'])
                                break;
                        ?>
                    <?php endfor; ?>
                    <div class="places-edit-menu">
                        <input class="inpt change-count number_places" value="10">
                        <span class="span-btn change-count-places">Изменить ко-во мест</span>
                        <span class="span-btn delete-row">Удалить ряд</span>
                    </div>
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
