<?php


namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\helpers\Url;

class CityComponent extends Component
{
    public function init() {
        $subdomain = preg_replace("/\.\w+\.\w+$/",'', Yii::$app->request->getHostName());
        $city = $this->getCityNameBySubdomain($subdomain)['name'];

        if ($this->checkSubdomain($subdomain)) {
            Yii::$app->session->set('city', $city);
            Yii::$app->session->set('subdomain', $subdomain);
            Yii::$app->params['HostName'] = substr(Yii::$app->request->getHostName(), strpos( Yii::$app->request->getHostName(), "." ) + 1 );
        } else {
            Yii::$app->response->redirect('//' . $this->getMovieTheaters()[0]['subdomain_name'] . '.' . Yii::$app->request->getHostName());
            Yii::$app->params['HostName'] = Yii::$app->request->getHostName();
        }
    }

    public static function checkSubdomain($subdomain) {
        $sql = 'SELECT subdomain_name FROM movie_theaters WHERE subdomain_name = :subdomen';
        return Yii::$app->db->createCommand($sql)->bindParam(':subdomen', $subdomain)->queryScalar();
    }

    public static function getCityNameBySubdomain($subdomain) {
        $sql = 'SELECT name FROM cities WHERE id = (SELECT city_id FROM movie_theaters WHERE subdomain_name = :subdomen )';
        return Yii::$app->db->createCommand($sql)->bindParam(':subdomen', $subdomain)->queryOne();
    }

    public static function getMovieTheaterByCityId($id) {
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
}