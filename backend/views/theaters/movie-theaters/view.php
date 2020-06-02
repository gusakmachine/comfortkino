<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\theaters\MovieTheaters */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Movie Theaters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movie-theaters-view">

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
            'address',
            'google_map_img',
            [
                'attribute' => 'google_map_link',
                'contentOptions' => ['class' => 'truncate']
            ],
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
        ],
    ]) ?>

</div>
