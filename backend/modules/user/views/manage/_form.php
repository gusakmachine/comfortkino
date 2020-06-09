<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $signup backend\models\User */
/* @var $user backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($user, 'email') ?>

    <?= $form->field($user, 'pass')->passwordInput(['value' => ''])->label('Password') ?>

    <?= $form->field($user, 'roles')->checkboxList($user->getRolesDropdown()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
