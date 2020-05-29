<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;

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
            'date',
            [
                'attribute' => 'movie_id',
                'label' => 'Movie',
                'value' => function($model) {
                    return $model->movie->title;
                }
            ],
            [
                'attribute' => 'Times',
                'value' => function($model) {
                    $times = [];
                    foreach ($model->times as $item){
                        $times[] = $item['time'] . ' ( '. $item['price'] .' ₽ ) ';
                    }
                    return $times ? join(', ', $times) : null;
                }
            ],
            'hall_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
