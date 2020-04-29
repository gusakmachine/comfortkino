<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Movie;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFilm($filmID = '')
    {
        return $this->render('film');
    }

    public function actionGetMovies()
    {
        $this->layout = false;
        if (Yii::$app->request->isAjax) {
            $formData = Yii::$app->request->post();
            return $this->render('getMovies', [
                'date' => $formData['date']
            ]);
        }

        return null;
    }
}
