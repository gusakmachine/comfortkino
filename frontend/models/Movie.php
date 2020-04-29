<?php


namespace frontend\models;

use yii\db\ActiveRecord;
use Yii;

class Movie extends ActiveRecord
{
    public static function getMoviesForThisDate($date) {
        $sql = 'SELECT * FROM movies 
        WHERE id IN (
            SELECT movies_id FROM movies_dates 
            WHERE dates_id = (
                SELECT id FROM dates 
                WHERE date="2020-04-26" 
            ) 
            AND
            movies_id IN (
                SELECT movies_id FROM movies_movie_theaters 
                WHERE movie_theaters_id = ( 
                    SELECT id FROM movie_theaters WHERE id=1 
                )
            )
        )';
        $command = Yii::$app->db->createCommand($sql);
        $movies = $command->bindParam(':date', $date)->queryAll();

        return $movies;
    }
    public static function getMovieGenre($date) {
        $sql = 'SELECT * FROM movie WHERE id IN (SELECT movie_id FROM movie_to_dates WHERE date_id = (SELECT id FROM dates WHERE date=:"2020-04-25"))';
        $command = Yii::$app->db->createCommand($sql);
        $movies = $command->bindParam(':date', $date)->queryAll();

        return $movies;
    }
    public static function getMovieCountry($date) {
        $sql = 'SELECT * FROM movie WHERE id IN (SELECT movie_id FROM movie_to_dates WHERE date_id = (SELECT id FROM dates WHERE date=:date))';
        $command = Yii::$app->db->createCommand($sql);
        $movies = $command->bindParam(':date', $date)->queryAll();

        return $movies;
    }
    public static function getMoviePrice($date) {
        $sql = 'SELECT * FROM movie WHERE id IN (SELECT movie_id FROM movie_to_dates WHERE date_id = (SELECT id FROM dates WHERE date=:date))';
        $command = Yii::$app->db->createCommand($sql);
        $movies = $command->bindParam(':date', $date)->queryAll();

        return $movies;
    }
    public static function getMovieDirector($date) {
        $sql = 'SELECT * FROM movie WHERE id IN (SELECT movie_id FROM movie_to_dates WHERE date_id = (SELECT id FROM dates WHERE date=:date))';
        $command = Yii::$app->db->createCommand($sql);
        $movies = $command->bindParam(':date', $date)->queryAll();

        return $movies;
    }
    public static function getMovieSessionsForThisDay($date) {
        $sql = 'SELECT * FROM movie WHERE id IN (SELECT movie_id FROM movie_to_dates WHERE date_id = (SELECT id FROM dates WHERE date=:date))';
        $command = Yii::$app->db->createCommand($sql);
        $movies = $command->bindParam(':date', $date)->queryAll();

        return $movies;
    }
}