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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'address',
//            'google_map_img',
//            [
//                'attribute' => 'google_map_link',
//                'contentOptions' => ['class' => 'truncate']
//            ],
            'start_work_time',
            'end_work_time',
            [
                'attribute' => 'socials',
                'value' => function($model) {
         $text = [];
                    foreach ($model->socials as $item) {
                        for ($i = 0; $i < count(Yii::$app->params['movieTheaterSocials']); $i++) {
                            $text[] = $item[Yii::$app->params['movieTheaterSocials'][$i]];
                        }
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
                'attribute' => 'city_id',
                'label' => 'City',
                'value' => function($model) {
                    return $model->city->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
