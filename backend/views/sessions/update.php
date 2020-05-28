<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $sessions common\models\sessions\Sessions */
/* @var $sessionsTime common\models\sessions\Sessions */
/* @var $sessionsTimePrices common\models\sessions\Sessions */
/* @var array $time common\models\sessions\Sessions */
/* @var array $timePrice common\models\sessions\Sessions */

$this->title = 'Update Sessions: ' . $sessions->id;
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $sessions->id, 'url' => ['view', 'id' => $sessions->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sessions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'sessions' => $sessions,
        'sessionsTime' => $sessionsTime,
        'sessionsTimePrices' => $sessionsTimePrices,
        'time' => $time,
        'timePrice' => $timePrice
    ]) ?>

</div>
