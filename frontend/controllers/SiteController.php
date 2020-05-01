<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use frontend\components\CacheDuration;

use frontend\models\MovieTheater;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $length = false;//Yii::$app->cache->get('day_list_length');
        $dayList = false;//Yii::$app->cache->get('day_list');
        $endDayListIDX = 9; //week + this day + 1 because for ($i < 9) so max $i == 8

        if ($length < $endDayListIDX)
            $endDayListIDX -= $length;

        if (!$length) {
            $length = MovieTheater::getNumberOfDaysWithSessions(date('Y-m-d'));
            Yii::$app->cache->set('day_list_length', $length, CacheDuration::getSecondsToMidnight(date('Y-m-d', strtotime(('+' . $length+$endDayListIDX . ' day')))));
        }

        if (!$dayList) {
            $dayList = MovieTheater::generateDayList($length + $endDayListIDX, date('Y-m-d'));
            Yii::$app->cache->set('day_list', $dayList, CacheDuration::getSecondsToMidnight(date('Y-m-d', strtotime(('+' . $length+$endDayListIDX . ' day')))));
        }

        return $this->render('index', [
            'dayList' => $dayList,
            'endDayListIDX' => $endDayListIDX,
            'length' => $length
        ]);
    }

    public function actionFilm($filmID = '')
    {
        return $this->render('film');
    }

    public function actionMovies()
    {
        $this->layout = false;
        $post = Yii::$app->request->post();

        /*$sessions = Yii::$app->cache->get('sessions_' . $post['date']);
        $movies = Yii::$app->cache->get('movies_' . $post['date']);*/

        $sessions = false;
        $movies = false;

        if (!isset($post['date']))
            return null;

        if (!$sessions) {
            $sessions = MovieTheater::getSessions(Yii::$app->session->get('subdomain'), $post['date']);
            Yii::$app->cache->set('sessions_' . $post['date'], $sessions, CacheDuration::getSecondsToMidnight($post['date']));
        }

        if (!$movies) {
            $movies = MovieTheater::getMoviesForThisSession($sessions, $post['date']);
            Yii::$app->cache->set('movies_' . $post['date'], $movies, CacheDuration::getSecondsToMidnight($post['date']));
        }

        return $this->render('movies', [
            'sessions' => $sessions,
            'movies' => $movies
        ]);
    }
}
