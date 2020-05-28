<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;

//print_r($dataProvider);die;

?>
<div class="sessions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sessions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'date',
            [
                'attribute' => 'movie_id',
                'label' => 'Movie',
                'value' => function($model) {
                    return $model->movie->title;
                }
            ],
            [
                'attribute' => 'time',
                'value' => function($model) {
                    $array = [];
                    foreach ($model->time as $item){
                        $array[] = $item['time'];
                    }
                    return $array ? join(', ', $array) : null;
                }
            ],
            [
                'attribute' => 'timePrices',
                'value' => function($model) {
                    $array = [];
                    foreach ($model->timePrices as $item){
                        $array[] = $item['price'];
                    }
                    return $array ? join(', ', $array) : null;
                }
            ],
            'hall_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
