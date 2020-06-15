<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SvgIcons */

$this->title = 'Create Svg Icons';
$this->params['breadcrumbs'][] = ['label' => 'Svg Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="svg-icons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'file' => $file,
    ]) ?>

</div>
