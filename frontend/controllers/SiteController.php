<?php

namespace frontend\controllers;

use Yii;
use frontend\components\Controller;

use common\models\theaters\MovieTheaters;
use common\models\theaters\Halls;
use common\models\theaters\PlacesSets;
use common\models\theaters\PlacePrices;

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

        return $this->render('index', [
            'dayList' => MovieTheater::generateDayList(date('Y-m-d'), $sessions),
            'futureMovies' => Movies::find() //get movies that are not added to the sessions
                ->where('release_date > :date', [':date' => $sessions ? $sessions[count($sessions) - 1]['date'] : date('Y-m-d')])
                ->with('genres')
                ->asArray()
                ->all(),
            'notes' => $notes,
            'owlAds' => $owlAds,
            'owlMovies' => $owlMovies,
            'branding_notes' => $brandingNotes,
        ]);
    }

    public function actionFilm($id)
    {
        $movie = Movies::find()->where('id = :id', [':id' => $id])->with('galleries', 'countries', 'genres', 'actors', 'directors')->asArray()->one();

        if (!$movie) return $this->goHome();

        $sessions = Sessions::find()
            ->with('time', 'timePrices')
            ->where(['>', 'date', date('Y-m-d', strtotime('- 1 day'))])
            ->andWhere(['movie_id' => $movie['id']])
            ->orderBy('date')
            ->asArray()
            ->all();

        return $this->render('film', [
            'sessions' => $sessions,
            'movie' => $movie,
        ]);
    }

    public function actionMovies()
    {
        $post = Yii::$app->request->post();
        $post['date'] = '2020-05-25';

        if (!isset($post['date']))
            return null;

        $sessions = Sessions::find()
            ->with('movie', 'time', 'timePrices')
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

        return $this->renderPartial('movies', [
            'sessions' => $sessions,
            'movies' => $movies
        ]);
    }

    public function actionTickets()
    {
        $formData = Yii::$app->request->post();

        $session = Sessions::find()->with('time', 'timePrices', 'tickets')->where(['id' => $formData['sessionID']])->asArray()->one();
        $hall = Halls::find()->with('placesSets')->where(['id' => $session['hall_id']])->asArray()->one();
        $hall['placesSets'] = PlacesSets::find()->with('colors', 'placePrice', 'tickets')->where(['set_id' => $hall['placesSets'][0]['set_id']])->orderBy('row')->asArray()->all(); // Shit, repair this fucking shit motherfuckers

        $movie = Movies::find()->where(['id' => $session['movie_id']])->asArray()->one();

        $prices = array_unique(array_column(array_column($hall['placesSets'], 'placePrice'), 'price'));
        $colors = array_unique(array_column(array_column($hall['placesSets'], 'colors'), 'color'));

        for ($i = 0; $i < count($hall['placesSets']); $i++)
            $hall['placesSets'][$i]['graphic_display'] = json_decode($hall['placesSets'][$i]['graphic_display'], true);

        return $this->renderAjax('tickets', [
            'session' => $session,
            'hall' => $hall,
            'movie' => $movie,
            'sessionTimeIDX' => $formData['timeID'],
            'prices' => $prices,
            'colors' => $colors,
            'movieTheater' => Yii::$app->cityComponent->getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'))
        ]);
    }
}


