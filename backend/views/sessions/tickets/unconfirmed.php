<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\TicketsAsset;

TicketsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\sessions\SeacrhTickets */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Неподтвержденные билеты';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(['id' => 'unconfirmed-tickets']) ?>
    <?= Html::a("Обновлять", ['sessions/tickets/unconfirmed'], ['class' => 'refresh-btn btn btn-lg btn-primary']);?>
    <?= Html::button("Остановить обновление", ['class' => 'stop-refresh-btn btn btn-lg btn-primary']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'customer_phone', 'label' => 'Номер телефона'],
            //['attribute' => 'status', 'label' => 'Статус',],
            ['attribute' => 'cities_name','label' => 'Город', 'value'=>'city.name'],
            ['attribute' => 'movie_theaters_title','label' => 'Кинотеатр', 'value'=>'movieTheaters.name'],
            ['attribute' => 'halls_name','label' => 'Зал', 'value'=>'hall.name'],
            ['attribute' => 'movies_title','label' => 'Фильм', 'value'=>'movie.title'],
            ['attribute' => 'sessions_date','label' => 'Дата сеанса', 'value'=>'sessions.date'],
            ['attribute' => 'times_time','label' => 'Время сеанса', 'value'=>'times.time'],
            ['attribute' => 'times_price','label' => 'Цена сеанса', 'value'=>'times.price'],
            ['attribute' => 'placesSets_place','label' => 'Место', 'value'=>'place.place'],
            ['attribute' => 'placesSets_row','label' => 'Ряд', 'value'=>'place.row'],
            ['attribute' => 'placesSets_price','label' => 'Цена за место', 'value'=>'place.price'],
            ['attribute' => 'created_at', 'label' => 'Время заказа',],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end() ?>
