<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ads\OwlMovies */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Owl Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="owl-movies-view">

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
            [
                'attribute' => 'Movie',
                'value' => function($model) {
                    return $model->movie->title;
                }
            ],
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
