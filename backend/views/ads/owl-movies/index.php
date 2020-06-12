<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ads\SearchOwlMovies */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Owl Movies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owl-movies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Owl Movies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            'end_date:datetime',
            'created_at:datetime',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
