<?php

namespace backend\controllers;

use common\models\sessions\SessionsTime;
use common\models\sessions\SessionsTimePrices;
use common\models\sessions\Time;
use common\models\sessions\TimePrices;
use Yii;
use common\models\sessions\Sessions;
use yii\data\ActiveDataProvider;
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

    /**
     * Lists all Sessions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sessions::find()->with('movie', 'time', 'timePrices'),
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
        $sessionsTime = new SessionsTime();
        $sessionsTimePrices = new SessionsTimePrices();

        if ($sessions->load(Yii::$app->request->post()) && $sessionsTime->load(Yii::$app->request->post()) && $sessionsTimePrices->load(Yii::$app->request->post())) {
            if ($sessions->validate() && $sessionsTime->validate() && $sessionsTimePrices->validate()){
                if ($sessions->save() && $sessionsTime->saveMultiply($sessionsTime->time_id, $sessions->id) && $sessionsTimePrices->saveMultiply($sessionsTimePrices->time_prices_id, $sessions->id)) {
                    return $this->redirect(['view', 'id' => $sessions->id]);
                }
            }
        }

        return $this->render('create', [
            'sessions' => $sessions,
            'sessionsTime' => $sessionsTime,
            'sessionsTimePrices' => $sessionsTimePrices,
            'time' => Time::find()->all(),
            'timePrice' => TimePrices::find()->all()
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
        $sessionsTime = new SessionsTime();
        $sessionsTimePrices = new SessionsTimePrices();

        $sessionsTime->time_id = $sessions->getTime()->all();
        $sessionsTimePrices->time_prices_id = $sessions->getTimePrices()->all();

        if ($sessions->load(Yii::$app->request->post()) && $sessionsTime->load(Yii::$app->request->post()) && $sessionsTimePrices->load(Yii::$app->request->post())) {
            if ($sessions->validate() && $sessionsTime->validate() && $sessionsTimePrices->validate()){
                SessionsTime::deleteAll('sessions_id = :sessions_id', [':sessions_id' => $sessions->id]);
                SessionsTimePrices::deleteAll('sessions_id = :sessions_id', [':sessions_id' => $sessions->id]);

                if ($sessions->save() && $sessionsTime->saveMultiply($sessionsTime->time_id, $sessions->id) && $sessionsTimePrices->saveMultiply($sessionsTimePrices->time_prices_id, $sessions->id)) {
                    return $this->redirect(['view', 'id' => $sessions->id]);
                }
            }
        }

        return $this->render('update', [
            'sessions' => $sessions,
            'sessionsTime' => $sessionsTime,
            'sessionsTimePrices' => $sessionsTimePrices,
            'time' => Time::find()->all(),
            'timePrice' => TimePrices::find()->all()
        ]);
    }

    /**
     * Deletes an existing Sessions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
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
}
