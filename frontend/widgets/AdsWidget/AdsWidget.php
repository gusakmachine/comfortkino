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
            ->orderBy('type_id')
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

        $renderedAds = [];

        /*for ($i = 0, $startIDX = 0; ; $i++) {
            while ($i < count($ads) && $ads[$i]['type']['name'] == $ads[$startIDX]['type']['name'])
                $i++;

            $renderedAds[$ads[$startIDX]['type']['name']] = $this->render($ads[$startIDX]['type']['name'], [
                'ads' => $ads,
                'sessions' => $sessions,
                'movies' => $movies,
                'startIDX' => $startIDX,
                'endIDX' => $i,
            ]);

            if ($i == count($ads))
                break;

            $startIDX = $i;
        }*/

        //print_r($renderedAds);
    }
}