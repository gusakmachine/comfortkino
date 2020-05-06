<?php

namespace frontend\widgets\AdsWidget;

use yii\base\Widget;

use yii\helpers\ArrayHelper;

use app\models\Ads;
use app\models\Movies;
use app\models\Sessions;
use function foo\func;

class AdsWidget extends Widget
{
    public function run()
    {
        $ads = Ads::find()
            ->with('type')
            ->where(['visibility' => 1])
            ->asArray()
            ->orderBy('movie_id')
            ->all();

        usort($ads, function($a, $b) {
           return ($a['type']['pos_index'] > $b['type']['pos_index'])? 1 : 0;
        });

        $movies = Movies::find()
            ->with('genres')
            ->where(['id' => array_map('intval', ArrayHelper::getColumn($ads, 'movie_id'))])
            ->asArray()
            ->all();

        $sessions = Sessions::find()
            ->with('time', 'timePrices')
            ->where(['movie_id' => array_map('intval', ArrayHelper::getColumn($movies, 'id'))])
            ->andWhere(['>', 'date', date('Y-m-d', strtotime('- 1 day'))])
            ->orderBy('movie_id')
            ->asArray()
            ->all();

        for ($i = 0, $j = 0, $k = 0; $i < count($ads); $i++) {
            $ads[$i]['counter_time'] = 0;
            if ($ads[$i]['movie_id'] == $movies[$j]['id']) {
                $ads[$i]['movie'] = $movies[$j];

                for ( ; $k < count($sessions); $k++) {
                    if ($movies[$j]['id'] != $sessions[$k]['movie_id'])
                        break;

                    $ads[$i]['sessions'][] = $sessions[$k];
                    $ads[$i]['counter_time'] += count($sessions[$k]['time']);
                }

                if ($j < count($movies) - 1)
                    $j++;
            }
        }

        return $this->render('index', [
            'ads' => $ads,
        ]);
    }
}