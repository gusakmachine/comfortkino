<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\theaters\PlacesSets;

/* @var $this yii\web\View */
/* @var $model common\models\sessions\Tickets */

$this->title = $model['id'];
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model['id']], [
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
            ['attribute' => 'customer_phone', 'label' => 'Номер телефона'],
            ['attribute' => 'status', 'label' => 'Статус'],
            ['attribute' => 'city.name', 'label' => 'Город'],
            ['attribute' => 'movieTheaters.name', 'label' => 'Кинотеатр'],
            ['attribute' => 'hall.name', 'label' => 'Зал'],
            ['attribute' => 'sessions.date', 'label' => 'Дата сеанса'],
            [
                'label' => 'Место',
                'value' => $place['place']
            ],
            [
                'label' => 'Ряд',
                'value' => $place['row']
            ],
            [
                'label' => 'Цена места',
                'value' => $place['price']['price']
            ],
            ['attribute' => 'movie.title', 'label' => 'Фильм'],
            ['attribute' => 'times.time', 'label' => 'Время сеанса'],
            ['attribute' => 'times.price', 'label' => 'Цена сеанса'],
            ['attribute' => 'created_at', 'label' => 'Время создания'],
            ['attribute' => 'updated_at', 'label' => 'Время последнего обновления'],
            [
                'label' => 'Суммарная цена',
                'value' => $totalPrice
            ],
        ],
    ]) ?>

</div>
