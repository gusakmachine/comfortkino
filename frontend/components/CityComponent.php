<?php

namespace frontend\components;

use Yii;
use yii\base\Component;

class CityComponent extends Component
{
    public function init() {
        $subdomain = preg_replace("/\.\w+\.\w+$/",'', Yii::$app->request->getHostName());

        if($subdomain != Yii::$app->session->get('subdomain')){
            $city = self::getCityNameBySubdomain($subdomain);
            if ($city) {
                $theater = self::getMovieTheaterBySubdomain($subdomain);
                Yii::$app->session->set('city', $city['name']);
                Yii::$app->session->set('subdomain', $subdomain);
                Yii::$app->session->set('theaterName', $theater['name']);
            } else {
                self::redirect();
            }
        }
        Yii::$app->params['HostName'] = substr(Yii::$app->request->getHostName(), strpos( Yii::$app->request->getHostName(), "." ) + 1 );
    }

    public static function getMovieTheaterBySubdomain($subdomain) {
        $sql = 'SELECT * FROM movie_theaters WHERE subdomain_name = :subdomain';
        return Yii::$app->db->createCommand($sql)->bindParam(':subdomain', $subdomain)->queryOne();
    }

    public static function getCityNameBySubdomain($subdomain) {
        $sql = 'SELECT name FROM cities WHERE id = (SELECT city_id FROM movie_theaters WHERE subdomain_name = :subdomain )';
        return Yii::$app->db->createCommand($sql)->bindParam(':subdomain', $subdomain)->queryOne();
    }

    public static function getMovieTheatersByCityId($id) {
        $sql = 'SELECT * FROM movie_theaters WHERE city_id = :id';
        return Yii::$app->db->createCommand($sql)->bindParam(':id', $id)->queryAll();
    }

    public static function getMovieTheaters() {
        $sql = 'SELECT * FROM movie_theaters';
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function getCities() {
        $sql = 'SELECT * FROM cities';
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function redirect() {
        header('Location: //' . self::getMovieTheaters()[0]['subdomain_name'] . '.' . Yii::$app->request->getHostName());
        exit;
    }
}