<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use app\models\MovieTheaters;
use app\models\Halls;
use app\models\Sessions;
use app\models\Movies;


use frontend\components\CacheDuration;
use frontend\components\MovieTheater;

use yii\helpers\ArrayHelper;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $length = Sessions::find()->where('date > :date', [':date' => date('Y-m-d', strtotime('- 1 day'))])->count();

        $endDayListIDX = 9; //week + this day + 1 because for ($i < 9) so max $i == 8

        if ($length < $endDayListIDX)
            $endDayListIDX -= $length;

        $dayList = MovieTheater::generateDayList($length + $endDayListIDX, date('Y-m-d'));
        $lastSession = Sessions::find()->select('date')->orderBy('date DESC')->limit(1)->asArray()->one();
        $futureMovies = Movies::find()->where('release_date > :date', [':date' => $lastSession['date']])->with('genres')->asArray()->all();

        return $this->render('index', [
            'dayList' => $dayList,
            'endDayListIDX' => $endDayListIDX,
            'length' => $length,
            'futureMovies' => $futureMovies,
        ]);
    }

    public function actionFilm($id)
    {
        $movie = Movies::find()->where('id = :id', [':id' => $id])->with('galleries', 'countries', 'genres', 'actors', 'directors')->asArray()->one();

        if(!$movie) return $this->goHome();

        $sessions = Sessions::find()
            ->with('time')
            ->where(['>', 'date', '2020-04-30'])
            ->andWhere(['movie_id' => $movie['id']])
            ->asArray()
            ->all();

        $dayList = $sessions ? MovieTheater::generateDayList(count($sessions), $sessions[0]['date']) : '';

        return $this->render('film', [
            'sessions' => $sessions,
            'movie' => $movie,
            'dayList' => $dayList,
        ]);
    }

    public function actionMovies()
    {
        $this->layout = false;
        $post = Yii::$app->request->post();

        if (!isset($post['date']))
            return null;

        //$sessions = Yii::$app->cache->get('sessions' . $post['date']);
        //$movies = Yii::$app->cache->get('movies' . $post['date']);

        $sessions = Sessions::find()
            ->with('time')
            ->where(['>', 'date', $post['date']])
            ->andWhere(['hall_id' => array_map(
                'intval', ArrayHelper::getColumn(
                Halls::find()
                    ->select('id')
                    ->where(['movie_theaters_id' => MovieTheaters::find()
                            ->select(['id'])
                            ->where(['subdomain_name' => Yii::$app->session->get('subdomain')])
                            ->one()]
                    )->asArray()
                    ->all(), 'id'
            )
            )
            ])->asArray()
            ->all();

        $movies = Movies::find()
            ->with('genres', 'countries')
            ->where(['id' => array_map('intval', ArrayHelper::getColumn($sessions, 'movie_id'))]
            )->asArray()->all();


        return $this->render('movies', [
            'sessions' => $sessions,
            'movies' => $movies
        ]);
    }
}
