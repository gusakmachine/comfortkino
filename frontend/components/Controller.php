<?php

namespace frontend\components;

use yii\web\Controller as BaseController;
use yii\base\Action;
use Yii;

class Controller extends BaseController
{
    public $movieTheater;

    public function beforeAction($action)
    {
        //for layout/main.php, !rework!
        $movieTheater = Yii::$app->cityComponent->getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'));

        $this->movieTheater = [];
        $this->movieTheater['google-map-img'] = $movieTheater ? $movieTheater['google-map-img'] : '';
        $this->movieTheater['google-map-link'] = $movieTheater ? $movieTheater['google-map-link'] : '';
        $this->movieTheater['movie-theater-address'] = $movieTheater ? $movieTheater['address'] : '';

        return parent::beforeAction($action);
    }
}