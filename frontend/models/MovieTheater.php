<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

use frontend\components\CacheDuration;

class MovieTheater extends Model
{
    public static function getSessions($movieTheaterName, $date)
    {
        $sql = 'SELECT * FROM sessions 
                WHERE `date` = :date
                AND
                hall_id IN (
                    SELECT id FROM halls WHERE movie_theaters_id = (
                        SELECT id FROM movie_theaters WHERE subdomain_name = :movieTheaterName
                    )
                )';

        $params = [
            ':movieTheaterName' => $movieTheaterName,
            ':date' => $date,
        ];

        $command = Yii::$app->db->createCommand($sql);
        $sessions = $command->bindValues($params)->queryAll();

        $sessionsIDXs = [];

        for ($i = 0; $i < count($sessions); $i++)
            $sessionsIDXs[$i] = $sessions[$i]['id'];

        $sessions_time = (new Query())
            ->select('sessions.id, time')
            ->from('sessions_time')
            ->join('INNER JOIN', 'sessions', 'sessions.id = sessions_time.sessions_id')
            ->join('INNER JOIN', 'time', 'time.id = sessions_time.time_id')
            ->where(['sessions.id' => $sessionsIDXs])
            ->orderBy('sessions.id')
            ->all();


        for ($i = 0, $j = 0; $i < count($sessions); $i++) {
            $sessions[$i]['time'] = [];
            for (; $j < count($sessions_time); $j++) {
                if ($sessions_time[$j]['id'] != $sessions[$i]['id']) break;
                array_push($sessions[$i]['time'], $sessions_time[$j]['time']);
            }
        }

        return $sessions;
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

    public static function getNumberOfDaysWithSessions($date)
    {
        return intval((new Query())
            ->select('COUNT(date) AS length')
            ->from('sessions')
            ->where('date > :date', [':date' => $date])
            ->one()['length']);
    }
    public static function generateDayList($length, $date)
    {
        $dayList = [];

        $date = date_parse($date);

        for ($i = 0; $i < $length; $i++) {
            switch ($i) {
                case 0:
                    $day_of_week = 'Сегодня';
                    break;
                case 1:
                    $day_of_week = 'Завтра';
                    break;
                default:
                    $day_of_week = Yii::$app->formatter->asDate(mktime(0, 0, 0, $date['month'], $date['day'] + $i, $date['year']), 'eeee');

            }

            $dayList[$i] = [
                'day-of-week' => mb_strtoupper(mb_substr($day_of_week, 0, 1, 'utf-8'), 'utf-8') . mb_substr($day_of_week, 1, strlen($day_of_week), 'utf-8'),
                'month' => Yii::$app->formatter->asDate($date['month'] + strtotime("+" . $i . " day"), 'MMMM'),
                'day' => Yii::$app->formatter->asDate($date['day'] + strtotime("+" . $i . " day"), 'dd'),
            ];
        }

        return $dayList;
    }
}