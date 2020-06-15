<?php

namespace frontend\controllers;

use common\models\theaters\Cities;
use frontend\components\CityComponent;
use Yii;
use frontend\components\Controller;

use common\models\theaters\MovieTheaters;
use common\models\theaters\Halls;
use common\models\theaters\PlacesSets;

use common\models\sessions\Sessions;
use common\models\sessions\Tickets;

use common\models\movies\Movies;

use common\models\ads\Notes;
use common\models\ads\OwlAds;
use common\models\ads\OwlMovies;
use common\models\ads\BrandingNotes;

use frontend\models\services\OwlMoviesService;

use frontend\components\CacheDuration;
use frontend\components\MovieTheater;

use yii\helpers\ArrayHelper;

class SiteController extends Controller
{

    public $model;

    public function actionIndex()
    {
        $cache = Yii::$app->cache;
        $cacheKey = CityComponent::getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'))['id'];
        $cacheSubKey = date('Y-m-d') . '_index';

        //if (empty($cache->get($cacheKey))) {
            $sessions = Sessions::find()
                ->select('date')
                ->where('date > :date', [':date' => date('Y-m-d', strtotime('- 1 day'))])
                ->groupBy('date')
                ->asArray()
                ->all();

            $brandingNotes = BrandingNotes::find()
                ->where('end_date > :date', [':date' => date('Y-m-d')])
                ->asArray()
                ->all();
            $notes = Notes::find()
                ->where('end_date > :date', [':date' => date('Y-m-d')])
                ->asArray()
                ->all();
            $owlAds = OwlAds::find()
                ->where('end_date > :date', [':date' => date('Y-m-d')])
                ->asArray()
                ->all();
            $owlMovies = OwlMoviesService::collectAll(
                OwlMovies::find()
                    ->where('end_date > :date', [':date' => date('Y-m-d')])
                    ->asArray()
                    ->all(),
                Yii::$app->params['maxCountTimesInOwl']
            );
            $dayList = MovieTheater::generateDayList(date('Y-m-d'), $sessions);
            $futureMovies = Movies::find() //get movies that are not added to the sessions
                ->where('release_date > :date', [':date' => $sessions ? $sessions[count($sessions) - 1]['date'] : date('Y-m-d')])
                ->with('genres')
                ->asArray()
                ->all();

            $newCacheData = $cache->get($cacheKey);
            $newCacheData[$cacheSubKey] = [
                'notes' => $notes,
                'owlMovies' => $owlMovies,
                'owlAds' => $owlAds,
                'branding_notes' => $brandingNotes,
                'dayList' => $dayList,
                'futureMovies' => $futureMovies,
            ];

            $cache->set($cacheKey, $newCacheData, CacheDuration::getSecondsToMidnight(date('Y-m-d')));
       //}

        return $this->render('index', $cache->get($cacheKey)[$cacheSubKey]);
    }

    public function actionUnconfirmedTickets() {
        if (Tickets::saveWithPlaces(Yii::$app->request->post()))
            return 'Ожидайте звонка';
    }

    public function actionFilm($id)
    {
        $cache = Yii::$app->cache;
        $cacheKey = CityComponent::getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'))['id'];
        $cacheSubKey = date('Y-m-d') . '_film_id_' . $id;

        //if (empty($cache->get($cacheKey))) {
            $movie = Movies::find()->where('id = :id', [':id' => $id])->with('gallery', 'countries', 'genres', 'actors', 'directors')->asArray()->one();

            if (!$movie) return $this->goHome();

            $sessions = Sessions::find()
                ->with('times')
                ->where(['>', 'date', date('Y-m-d', strtotime('- 1 day'))])
                ->andWhere(['movie_id' => $movie['id']])
                ->orderBy('date')
                ->asArray()
                ->all();

            $newCacheData = $cache->get($cacheKey);
            $newCacheData[$cacheSubKey] = [
                'sessions' => $sessions,
                'movie' => $movie,
            ];

            $cache->set($cacheKey, $newCacheData, CacheDuration::getSecondsToMidnight(date('Y-m-d')));
        //}

        return $this->render('film', $cache->get($cacheKey)[$cacheSubKey]);
    }

    public function actionMovies()
    {
        $post = Yii::$app->request->post();
        //$post['date'] = '2020-05-25';

        if (!isset($post['date']))
            return null;

        $cache = Yii::$app->cache;
        $cacheKey = CityComponent::getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'))['id'];
        $cacheSubKey = date('Y-m-d') . '_movies_' . $post['date'];

        //if (empty($cache->get($cacheKey))) {
            $sessions = Sessions::find()
                ->with('movie', 'times')
                ->where(['date' => $post['date']])
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

            $newCacheData = $cache->get($cacheKey);
            $newCacheData[$cacheSubKey] = [
                'sessions' => $sessions,
                'movies' => $movies,
            ];

            $cache->set($cacheKey, $newCacheData, CacheDuration::getSecondsToMidnight(date('Y-m-d')));
        //}

        return $this->renderPartial('movies', $cache->get($cacheKey)[$cacheSubKey]);
    }

    public function actionTickets()
    {
        $formData = Yii::$app->request->post();

        $movieTheater = CityComponent::getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'));
        $city = Cities::find()->where(['id' => $movieTheater['city_id']])->one();

        $session = Sessions::find()->with('times')->where(['id' => $formData['sessionID']])->asArray()->one();
        $movie = Movies::find()->where(['id' => $session['movie_id']])->asArray()->one();
        $hall = Halls::find()->where(['id' => $session['hall_id']])->asArray()->one();
        $hall['places'] = PlacesSets::getSet([
            'session' => $session,
            'sessionTimeIDX' => $session['times'][$formData['timeID']]['id'],
            'hall' => $hall,
            'movie' => $movie,
        ]);

        for ($i = 0; $i < count($hall['places']); $i++)
            $hall['places'][$i]['graphic_display'] = json_decode($hall['places'][$i]['graphic_display'], true);

        $prices = array_unique(array_column(array_column($hall['places'], 'price_id'), 'price'));
        $colors = array_unique(array_column(array_column($hall['places'], 'color_id'), 'color'));

        return $this->renderAjax('tickets', [
            'session' => $session,
            'sessionTimeIDX' => $formData['timeID'],
            'hall' => $hall,
            'movie' => $movie,
            'colors' => $colors,
            'prices' => $prices,
            'movieTheater' => $movieTheater,
            'city' => $city,
        ]);
    }
}


