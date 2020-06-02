<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $sessions common\models\sessions\Sessions */
/* @var $times common\models\sessions\Sessions */
/* @var $movies common\models\sessions\Sessions */

$this->title = 'Create Sessions';
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'sessions' => $sessions,
        'times' => $times,
        'movies' => $movies,
    ]) ?>

</div>
