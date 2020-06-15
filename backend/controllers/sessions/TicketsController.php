<?php

namespace backend\controllers\sessions;

use Cassandra\Time;
use common\models\movies\Movies;
use common\models\sessions\Sessions;
use common\models\sessions\Times;
use common\models\theaters\Cities;
use common\models\theaters\Halls;
use common\models\theaters\MovieTheaters;
use common\models\theaters\PlacesSets;
use Yii;
use common\models\sessions\Tickets;
use common\models\sessions\SeacrhTickets;
use backend\components\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'unconfirmed', 'view', 'update', 'delete', 'create'],
                        'roles' => ['moderator'],
                    ],
                ],
            ],
        ];
    }
    public static function controllerName() {
        return 'Билеты';
    }
    /**
     * Lists all Tickets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeacrhTickets();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUnconfirmed()
    {
        /*$query = Tickets::find()->where(['status' => 0]);
        $query->joinWith(['city']);
        $query->joinWith(['movieTheaters']);
        $query->joinWith(['hall']);
        $query->joinWith(['movie']);
        $query->joinWith(['sessions']);
        $query->joinWith(['times']);
        $query->joinWith(['place']);
        $query->leftJoin('place_prices', '{{place_prices}}.[[id]] = 1');

        $query->asArray()->all();

        print_r($query);die;*/

        $searchModel = new SeacrhTickets();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('unconfirmed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tickets model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Tickets::find()->with('city', 'movieTheaters', 'hall', 'movie', 'sessions', 'times')->where(['id' => $id])->asArray()->one();
        $place = PlacesSets::getPlaceWithPrice($model['place_id']);
        $totalPrice = Tickets::getTotalPrice($model, $place);

        return $this->render('view', [
            'model' => $model,
            'place' => $place,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Creates a new Tickets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tickets();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tickets model.
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
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
