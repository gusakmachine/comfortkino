<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\BrandingNotes */

$this->title = 'Create Branding Notes';
$this->params['breadcrumbs'][] = ['label' => 'Branding Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branding-notes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>