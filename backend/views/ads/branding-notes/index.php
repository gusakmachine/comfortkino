<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ads\SearchBrandingNotes */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branding Notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branding-notes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Branding Notes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text',
            'link_text',
            'svg_image_name',
            'href',
            [
                'attribute' => 'Theater',
                'value' => function($model) {
                    return $model->movieTheaters->name;
                }
            ],
            //'end_date',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
