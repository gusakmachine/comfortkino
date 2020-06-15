<?php

namespace backend\controllers\theaters;

use common\models\Colors;
use common\models\movies\Gallery;
use common\models\theaters\MovieTheaters;
use common\models\theaters\PlacePrices;
use common\models\theaters\PlacesSets;
use Yii;
use common\models\theaters\Halls;
use common\models\theaters\SearchHalls;
use backend\components\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HallsController implements the CRUD actions for Halls model.
 */
class HallsController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'delete', 'create'],
                        'roles' => ['moderator'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Halls models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchHalls();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Halls model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $places = PlacesSets::getSet($model['places_sets_id']);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'places' => $places,
        ]);
    }

    /**
     * Creates a new Halls model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Halls();

        if ($post = Yii::$app->request->post()) {
            if (isset($post['Places']) && $places_models = PlacesSets::loadPlaces($post['Places'])) {
                $post['Halls']['places_sets_id'] = $places_models[0]['set_id'];
                if (PlacesSets::saveMultiple($places_models)) {
                    $model->load($post);
                    if ($model->save())
                        return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'movie_theaters' => ArrayHelper::map(MovieTheaters::find()->asArray()->all(), 'id', 'name'),
            'colors' => Colors::find()->asArray()->all()
        ]);
    }

    /**
     * Updates an existing Halls model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $places = PlacesSets::find()->with('color')->where(['set_id' => $model['places_sets_id']])->all();

        if ($post = Yii::$app->request->post()) {
            if (isset($post['Halls']['places_sets_id']))
                PlacesSets::deleteAll('set_id = :places_sets_id', [':places_sets_id' => $post['Halls']['places_sets_id']]);

            if (isset($post['Places']) && $places_models = PlacesSets::loadPlaces($post['Places'])) {
                if (PlacesSets::saveMultiple($places_models)) {
                    $model->load($post);
                    if ($model->save())
                        return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'places' => $places,
            'colors' => Colors::find()->asArray()->all(),
            'movie_theaters' => ArrayHelper::map(MovieTheaters::find()->asArray()->all(), 'id', 'name'),
        ]);
    }

    /**
     * Deletes an existing Halls model.
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
     * Finds the Halls model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Halls the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Halls::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
