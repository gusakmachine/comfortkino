<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ads\PageBackground */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Page Backgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-background-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'background_image_name',
            [
                'attribute' => 'Theater',
                'value' => function($model) {
                    return $model->movieTheaters->name;
                }
            ],
            'end_date',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
