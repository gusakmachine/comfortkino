<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movie Theaters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movie-theaters-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Movie Theaters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'address',
            'start_work_time',
            'end_work_time',
            [
                'attribute' => 'vk',
                'contentOptions' => ['class' => 'truncate'],
                'value' => function($model) {
                    $text = [];
                    foreach ($model->socials as $item) {
                        $text[] = $item[Yii::$app->params['movieTheaterSocials'][0]];
                    }
                    return $text ? join(', ', $text) : null;
                }

            ],
            [
                'attribute' => 'facebook',
                'contentOptions' => ['class' => 'truncate'],
                'value' => function($model) {
                    $text = [];
                    foreach ($model->socials as $item) {
                        $text[] = $item[Yii::$app->params['movieTheaterSocials'][1]];
                    }
                    return $text ? join(', ', $text) : null;
                }
            ],
            [
                'attribute' => 'instagram',
                'contentOptions' => ['class' => 'truncate'],
                'value' => function($model) {
                    $text = [];
                    foreach ($model->socials as $item) {
                        $text[] = $item[Yii::$app->params['movieTheaterSocials'][2]];
                    }
                    return $text ? join(', ', $text) : null;
                }
            ],
            [
                'attribute' => 'phoneNumbers',
                'value' => function($model) {
                    $phones = [];

                    foreach ($model->phoneNumbers as $item) {
                        $phones[] = $item['phone'];
                    }
                    return $phones ? join(', ', $phones) : null;
                }
            ],
            'subdomain_name',
            [
                'attribute' => 'city',
                'label' => 'City',
                'value' => function($model) {
                    return $model->city->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
