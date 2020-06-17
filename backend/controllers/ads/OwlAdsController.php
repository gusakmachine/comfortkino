<?php

namespace backend\controllers\ads;

use common\models\theaters\MovieTheaters;
use common\models\UploadForm;
use Yii;
use common\models\ads\OwlAds;
use common\models\ads\SearchOwlAds;
use backend\components\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OwlAdsController implements the CRUD actions for OwlAds model.
 */
class OwlAdsController extends Controller
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

    public static function controllerName() {
        return 'Карусель-объявления';
    }

    /**
     * Lists all OwlAds models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchOwlAds();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OwlAds model.
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
     * Creates a new OwlAds model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OwlAds();
        $file = new UploadForm();
        $movieTheaters = MovieTheaters::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            $file->dirname = Yii::getAlias('@owl-backgrounds/');
            $file->imageFiles= [UploadedFile::getInstance($file, 'imageFiles')];
            $model['background_image_name'] = '/' . $file->imageFiles[0]->name;

            if ($model->save() && $file->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'file' => $file,
            'movieTheaters' => ArrayHelper::map($movieTheaters, 'id', 'name'),
        ]);
    }

    /**
     * Updates an existing OwlAds model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $movieTheaters = MovieTheaters::find()->asArray()->all();

        $file = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $file->dirname = Yii::getAlias('@owl-backgrounds/');
            $file->imageFiles = [UploadedFile::getInstance($file, 'imageFiles')];

            if (empty($file->imageFiles) && $model->save())
                return $this->redirect(['view', 'id' => $model->id]);

            $model['background_image_name'] = '/' . $file->imageFiles[0]->name;

            if ($model->save() && $file->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'file' => $file,
            'movieTheaters' => ArrayHelper::map($movieTheaters, 'id', 'name'),
        ]);
    }

    /**
     * Deletes an existing OwlAds model.
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
     * Finds the OwlAds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OwlAds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OwlAds::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
