<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\MovieTheater;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index', [
            'title' => 'Otrada',
        ]);
    }

    public function actionFilm($filmID = '')
    {
        return $this->render('film');
    }

    public function actionMovies()
    {
        $this->layout = false;

        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();

            if (!isset($post['date']))
                $post['date'] = date('Y.m.d');

            return $this->render('movies', [
                'date' => $post['date'],
            ]);
        }

        return $this->render('movies', [
            'date' => date('Y.m.d'),
        ]);
    }
}
