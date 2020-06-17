<?php

namespace backend\controllers\ads;

use common\models\theaters\MovieTheaters;
use Yii;
use common\models\ads\PageBackground;
use common\models\ads\SearchPageBackground;
use backend\components\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadForm;
use yii\web\UploadedFile;
/**
 * PageBackgroundController implements the CRUD actions for PageBackground model.
 */
class PageBackgroundController extends Controller
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
        return 'Фон';
    }

    /**
     * Lists all PageBackground models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchPageBackground();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PageBackground model.
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
     * Creates a new PageBackground model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PageBackground();
        $file = new UploadForm();
        $movieTheaters = MovieTheaters::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            //please, don't beat me
            $file->dirname = Yii::getAlias('@page-backgrounds/');
            $file->imageFiles = [UploadedFile::getInstance($file, 'imageFiles')];
            $model['background_image_name'] = '/' . $file->imageFiles[0]->name;

            if ($model->save() && $file->upload()) {
                return $this->redirect(['view', 'id' => 1]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'file' => $file,
            'movieTheaters' => ArrayHelper::map($movieTheaters, 'id', 'name'),
        ]);
    }

    /**
     * Updates an existing PageBackground model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = new UploadForm();
        $movieTheaters = MovieTheaters::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if (empty($file->imageFiles) && $model->save())
                return $this->redirect(['view', 'id' => $model->id]);

            $file->dirname = Yii::getAlias('@page-backgrounds/');
            $file->imageFiles = [UploadedFile::getInstance($file, 'imageFiles')];
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
     * Deletes an existing PageBackground model.
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
     * Finds the PageBackground model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PageBackground the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PageBackground::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
