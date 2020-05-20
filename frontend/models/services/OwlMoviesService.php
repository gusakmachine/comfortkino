<?php

namespace app\models\services;

use app\models\Movies;
use app\models\Sessions;

class OwlMoviesService
{
    public function collectAll($owlMovies, $maxCountTimesInOwl) {
        $owlMovies = Movies::find()
            ->with('genres', 'countries')
            ->where(['id' => array_map('intval', array_column($owlMovies, 'movie_id'))])
            ->asArray()
            ->all();

        $sessions = Sessions::find()
            ->with('time', 'timePrices')
            ->where(['>', 'date', date('Y-m-d', strtotime('- 1 day'))])
            ->andWhere(['movie_id' => array_map('intval', array_column($owlMovies, 'id'))])
            ->orderBy('movie_id, date')
            ->asArray()
            ->all();

        for ($i = 0, $j = 0; $i < count($owlMovies); $i++) {
            if (isset($sessions[$j]['time']))
                $owlMovies[$i]['counter_time'] = 0 - (count($sessions[$j]['time']) > $maxCountTimesInOwl ? $maxCountTimesInOwl : count($sessions[$j]['time'])) ;
            for ( ; $j < count($sessions); $j++) {
                if ($sessions[$j]['movie_id'] != $owlMovies[$i]['id'])
                    break;

                $owlMovies[$i]['sessions'][] = $sessions[$j];
                $owlMovies[$i]['counter_time'] += count($sessions[$j]['time']);
            }
        }

        return $owlMovies;
    }
}