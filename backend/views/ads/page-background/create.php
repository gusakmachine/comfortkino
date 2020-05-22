<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ads\PageBackground */

$this->title = 'Create Page Background';
$this->params['breadcrumbs'][] = ['label' => 'Page Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-background-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
