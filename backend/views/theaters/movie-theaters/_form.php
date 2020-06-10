<?php

use kartik\select2\Select2;
use kartik\time\TimePicker;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $movieTheaters common\models\theaters\MovieTheaters */
/* @var $form yii\widgets\ActiveForm */

\backend\assets\ImagesAsset::register($this);

?>

<div class="movie-theaters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($movieTheaters, 'name')->textInput()->label('Название') ?>

    <?= $form->field($movieTheaters, 'address')->textInput()->label('Адресс') ?>

    <?= $form->field($movieTheaters, 'google_map_img')->fileInput(['class' => 'view-img-after-dwn', 'data-image-name' => 'google-map-img'])->label('Google-картинка') ?>

    <img class="google-map-img model-poster" style="display: <?= $movieTheaters['google_map_img'] ? 'block' : 'none' ?>" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@map_img') . $movieTheaters['google_map_img']; ?>" alt="image" />

    <?= $form->field($movieTheaters, 'google_map_link')->textInput()->label('<a href="https://www.google.com/maps/place/" target="_blank">Google, ссылка на место</a>') ?>

    <?= $form->field($movieTheaters, 'start_work_time')->widget(TimePicker::classname(),[
        'name' => 'start_work_time',
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ])->label('Время начала работа кинотеатра')?>

    <?= $form->field($movieTheaters, 'end_work_time')->widget(TimePicker::classname(),[
        'name' => 'end_work_time',
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ])->label('Время конца работы кинотеатра')?>

    <?= $form->field($socials, 'vk')->textInput() ?>
    <?= $form->field($socials, 'facebook')->textInput() ?>
    <?= $form->field($socials, 'instagram')->textInput() ?>

    <?= TabularInput::widget([
        'models' => $phones,
        'columns' => [
            [
                'name'  => 'phone',
                'title' => 'Телефоны',
            ],
        ],
    ]) ?>

    <?= $form->field($movieTheaters, 'subdomain_name')->textInput(['maxlength' => true])->label('Название кинотеатра на английском') ?>

    <?= $form->field($movieTheaters, 'city_id')->widget(Select2::classname(), [
        'data' => $cities,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Город');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
