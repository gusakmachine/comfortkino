<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

class MovieTheater extends Model
{
    public static function getSessions($movieTheaterName = NULL, $date = NULL)
    {
        $sql = 'select * from sessions 
                where `date` = :date
                and
                hall_id in (
                    select id from halls where movie_theaters_id = (
                        select id from movie_theaters where subdomain_name = :movieTheaterName
                    )
                )';

        $params = [
            ':movieTheaterName' => $movieTheaterName,
            ':date' => $date,
        ];

        $command = Yii::$app->db->createCommand($sql);

        return $command->bindValues($params)->queryAll();;
    }

    public static function getMoviesForThisSession($sessions)
    {
        $moviesIDXs = [];

        for ($i = 0; $i < count($sessions); $i++)
            $moviesIDXs[$i] = $sessions[$i]['movie_id'];


        $movies = (new Query())
            ->select('*')
            ->from('movies')
            ->where(['id' => $moviesIDXs])
            ->all();

        $genres = (new Query())
            ->select('movies.id, genres.name')
            ->from('movies_genres')
            ->join('INNER JOIN', 'movies', 'movies.id = movies_genres.movies_id')
            ->join('INNER JOIN', 'genres', 'genres.id = movies_genres.genres_id')
            ->where(['movies.id'=> $moviesIDXs])
            ->orderBy('movies.id')
            ->all();

        $countries = (new Query())
            ->select('movies.id, countries.name')
            ->from('movies_countries')
            ->join('INNER JOIN', 'movies', 'movies.id = movies_countries.movies_id')
            ->join('INNER JOIN', 'countries', 'countries.id = movies_countries.countries_id')
            ->where(['movies.id'=> $moviesIDXs])
            ->orderBy('movies.id')
            ->all();

        for ($i = 0, $j = 0, $k = 0; $i < count($movies); $i++) {
            $movies[$i]['genres'] = [];
            $movies[$i]['countries'] = [];

            for (; $j < count($genres); $j++) {
                if ($genres[$j]['id'] != $movies[$i]['id']) break;
                array_push($movies[$i]['genres'], $genres[$j]['name']);
            }
            for (; $k < count($countries); $k++) {
                if ($countries[$k]['id'] != $movies[$i]['id']) break;
                array_push($movies[$i]['countries'], $countries[$k]['name']);
            }
        }

        return $movies;
    }

    public static function getSessionTime($sessions)
    {
        $sessionsIDXs = [];

        for ($i = 0; $i < count($sessions); $i++)
            $sessionsIDXs[$i] = $sessions[$i]['id'];

        return (new Query())
            ->select('sessions.id, time')
            ->from('sessions_time')
            ->join('INNER JOIN', 'sessions', 'sessions.id = sessions_time.sessions_id')
            ->join('INNER JOIN', 'time', 'time.id = sessions_time.time_id')
            ->where(['sessions.id' => $sessionsIDXs])
            ->all();
    }
}