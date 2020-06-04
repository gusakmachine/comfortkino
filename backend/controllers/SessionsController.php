<?php

namespace backend\controllers;

use common\models\movies\Movies;
use common\models\sessions\Times;
use Yii;
use common\models\sessions\Sessions;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SessionsController implements the CRUD actions for Sessions model.
 */
class SessionsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public static function controllerName() {
        return 'Сеансы';
    }
    /**
     * Lists all Sessions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sessions::find()->with('movie', 'times'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sessions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sessions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $sessions = new Sessions();
        $times = [new Times()];
        $movies = Movies::find()->asArray()->all();

        if (Yii::$app->request->isPost) {
            $times = $this->prepareTimesArray(Yii::$app->request->post('Times', []), $times);
            if ($sessions->load(Yii::$app->request->post()) && Times::loadMultiple($times, Yii::$app->request->post())) {
                if ($sessions->validate() && Times::validateMultiple($times)) {
                    if ($sessions->save() && Times::saveMultiple($times,  $sessions->id)) {
                        return $this->redirect(['view', 'id' => $sessions->id]);
                    }
                }
            }
        }

        return $this->render('create', [
            'sessions' => $sessions,
            'times' => $times,
            'movies' => ArrayHelper::map($movies, 'id', 'title'),
        ]);
    }

    /**
     * Updates an existing Sessions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $sessions = $this->findModel($id);
        $times = $this->getTimesBySessionId($id);
        $movies = Movies::find()->asArray()->all();

        if (Yii::$app->request->isPost) {
            Times::deleteAll('sessions_id = :sessions_id', [':sessions_id' => $id]);
            $times = $this->prepareTimesArray(Yii::$app->request->post('Times', []));
            if ($sessions->load(Yii::$app->request->post()) && Times::loadMultiple($times, Yii::$app->request->post())) {
                if ($sessions->validate() && Times::validateMultiple($times)) {
                    if ($sessions->save() && Times::saveMultiple($times, $id)) {
                        return $this->redirect(['view', 'id' => $id]);
                    }
                }
            }
        }

        return $this->render('update', [
            'sessions' => $sessions,
            'times' => $times,
            'movies' => ArrayHelper::map($movies, 'id', 'title'),
        ]);
    }

    /**
     * Deletes an existing Sessions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sessions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sessions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sessions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * @param $id
     * @return array
     */
    private function getTimesBySessionId($id)
    {
        $data = Times::find()->where(['sessions_id' => $id])->asArray()->all();
        $items = [];
        foreach ($data as $row) {
            $item = new Times();
            $item->setAttributes($row);
            $items[] = $item;
        }
        return $items;
    }

    /**
     * @param $times
     * @return mixed
     */
    private function prepareTimesArray($formData, $times = []) {
        foreach (array_keys($formData) as $index) {
            $times[$index] = new Times();
        }
        return $times;
    }

}
