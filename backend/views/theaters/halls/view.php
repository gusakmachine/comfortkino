<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\PlacesEditorAsset;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\Halls */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Halls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
PlacesEditorAsset::register($this);
?>
<div class="halls-view">

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
            'capacity',
            'movie_theaters_id',
            'places_sets_id',
        ],
    ]) ?>

    <div class="hall">
        <?php for ($i = 0; $i < count($places); $i++): ?>
            <div class="rows">
                <p class="row_number"><?= $places[$i]['row']; ?> ряд</p>
                <?php for (; $i < count($places); $i++): ?>
                    <div class="places-wrapper">
                        <span class="places" style="background-color: <?= $places[$i]['color_id']->color; ?>"><?= $places[$i]['place']; ?></span>
                        <span class="place-price"><?= $places[$i]['price_id']->price; ?></span>
                    </div>
                    <?php
                        if (isset($places[$i + 1]) && $places[$i]['row'] != $places[$i + 1]['row'])
                            break;
                    ?>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>

</div>
