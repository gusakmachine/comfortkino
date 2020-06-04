<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\movies\Movies */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="movies-view">

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
            'title',
            'description:ntext',
            [
                'label'=> 'Actors',
                'value' => function ($model) {
                    $actors_list = '';

                    foreach ($model->relatedRecords['actors'] as $actor)
                        $actors_list = ($actors_list == '' ? '' : $actors_list . ', ') . $actor->name;

                    return $actors_list;
                }
            ],
            [
                'label'=> 'Genres',
                'value' => function ($model) {
                    $genres_list = '';

                    foreach ($model->relatedRecords['genres'] as $genre)
                        $genres_list = ($genres_list == '' ? '' : $genres_list . ', ') . $genre->name;

                    return $genres_list;
                }
            ],
            [
                'label'=> 'Countries',
                'value' => function ($model) {
                    $countries_list = '';

                    foreach ($model->relatedRecords['countries'] as $country)
                        $countries_list = ($countries_list == '' ? '' : $countries_list . ', ') . $country->name;

                    return $countries_list;
                }
            ],
            [
                'label'=> 'Directors',
                'value' => function ($model) {
                    $directors_list = '';

                    foreach ($model->relatedRecords['directors'] as $director)
                        $directors_list = ($directors_list == '' ? '' : $directors_list . ', ') . $director->name;

                    return $directors_list;
                }
            ],
            [
                'label'=> 'Gallery',
                'format'=>'raw',
                'value' => function($model) {
                    $gallery = '';

                    foreach ($model->relatedRecords['gallery'] as $gallery_image)
                        $gallery = $gallery . Html::img(Yii::getAlias('@frontend_link'). Yii::getAlias('@gallery') . '/' . $model['id'] . '/'  . $gallery_image->image_name, ['class' => 'model-gallery-image']);

                    return $gallery;
                },
            ],
            'duration',
            'age',
            [
                'label' => 'Poster',
                'format' => ['image',['class' => 'model-poster']],
                'value' => Yii::getAlias('@frontend_link'). Yii::getAlias('@posters') . '/' . $model['id'] . '/'  . $model->poster,
            ],
            [
                'label' => 'Mobile preview',
                'format' => ['image',['class' => 'model-mob-poster']],
                'value' => Yii::getAlias('@frontend_link'). Yii::getAlias('@mob_posters') . '/' . $model['id'] . '/'  . $model->mob_poster,
            ],
            'trailer',
            'release_date',
            'created_at',
            'updated_at',
        ],
    ]) ?>
</div>
