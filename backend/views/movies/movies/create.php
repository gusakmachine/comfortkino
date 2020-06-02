<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\movies\Movies */
/* @var $files common\models\UploadForm */

$this->title = 'Create Movies';
$this->params['breadcrumbs'][] = ['label' => 'Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'actors' => implode(', ', array_column($model->getActors()->asArray()->all(), 'name')),
        'directors' => implode(', ', array_column($model->getDirectors()->asArray()->all(), 'name')),
        'genres' => implode(', ', array_column($model->getGenres()->asArray()->all(), 'name')),
        'countries' => implode(', ', array_column($model->getCountries()->asArray()->all(), 'name')),
        'gallery_paths' => $model->getGallery()->asArray()->all(),
    ]) ?>

</div>
