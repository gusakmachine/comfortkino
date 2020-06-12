<?php

namespace frontend\components;

use common\models\theaters\PhoneNumbers;
use common\models\theaters\Socials;
use yii\web\Controller as BaseController;
use yii\base\Action;
use Yii;

use common\models\ads\PageBackground;

class Controller extends BaseController
{
    public $movieTheater;
    public $pageBackgroundPath;

    public function beforeAction($action)
    {
        //for layout/main.php, !rework!

        if ($movieTheater = Yii::$app->cityComponent->getMovieTheaterBySubdomain(Yii::$app->session->get('subdomain'))) {

            $socials = Socials::find()->where(['movie_theaters_id' => $movieTheater['id']])->asArray()->one();
            $phones = PhoneNumbers::find()->where(['movie_theaters_id' => $movieTheater['id']])->asArray()->all();

            $this->movieTheater = [];
            $this->movieTheater['google_map_img'] = $movieTheater ? $movieTheater['google_map_img'] : '';
            $this->movieTheater['google_map_link'] = $movieTheater ? $movieTheater['google_map_link'] : '';
            $this->movieTheater['movie-theater-address'] = $movieTheater ? $movieTheater['address'] : '';
            $this->movieTheater['start_work_time'] = $movieTheater ? $movieTheater['start_work_time'] : '';
            $this->movieTheater['end_work_time'] = $movieTheater ? $movieTheater['end_work_time'] : '';
            if ($socials) {
                for ($i = 0; $i < count(Yii::$app->params['movieTheaterSocials']); $i++) {
                    $this->movieTheater['socials'][] = $socials[Yii::$app->params['movieTheaterSocials'][$i]];
                }
            }
            if ($phones) {
                for ($i = 0; $i < count($phones); $i++) {
                    $this->movieTheater['phones'][] = $phones[$i]['phone'];
                }
            }
            $this->pageBackgroundPath = PageBackground::find()->where('end_date > :date', [':date' => date('Y-m-d')])->asArray()->one();
        } else {
            Yii::$app->cityComponent->redirect();
        }

        return parent::beforeAction($action);;
    }
}