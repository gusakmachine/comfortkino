<?php

namespace backend\controllers\ads;

use Yii;
use common\models\ads\PageBackground;
use common\models\ads\SearchPageBackground;
use yii\web\Controller;
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
        ];
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

        if ($model->load(Yii::$app->request->post())) {
            $file->imageFile = UploadedFile::getInstance($file, 'imageFile');
            $model['background_image_name'] = '/' . $file->imageFile->name;

            if ($model->save() && $file->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }


            return $this->render('create', [
            'model' => $model,
            'file' => $file
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

        if ($model->load(Yii::$app->request->post())) {
            $file->imageFile = UploadedFile::getInstance($file, 'imageFile');
            $model['background_image_name'] = '/' . $file->imageFile->name;

            if ($model->save() && $file->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'file' => $file
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
