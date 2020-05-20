<?php

namespace frontend\components;

use yii\web\Controller as BaseController;
use yii\base\Action;
use Yii;

use app\models\PageBackground;

class Controller extends BaseController
{
    public $movieTheater;
    public $pageBackgroundPath;

    public function beforeAction($action)
    {
        //for layout/main.php, !rework!
        $movieTheater = Yii::$app->cityComponent->getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'));

        $this->movieTheater = [];
        $this->movieTheater['google-map-img'] = $movieTheater ? $movieTheater['google-map-img'] : '';
        $this->movieTheater['google-map-link'] = $movieTheater ? $movieTheater['google-map-link'] : '';
        $this->movieTheater['movie-theater-address'] = $movieTheater ? $movieTheater['address'] : '';

        $this->pageBackgroundPath = PageBackground::find()->where('end_date > :date', [':date' => date('Y-m-d')])->asArray()->one();

        return parent::beforeAction($action);
    }
}