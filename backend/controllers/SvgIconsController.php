<?php

namespace backend\controllers;

use Yii;
use common\models\SvgIcons;
use common\models\SearchSvgIcons;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadForm;
use yii\web\UploadedFile;

/**
 * SvgIconsController implements the CRUD actions for SvgIcons model.
 */
class SvgIconsController extends Controller
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
     * Lists all SvgIcons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchSvgIcons();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SvgIcons model.
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
     * Creates a new SvgIcons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SvgIcons();
        $file = new UploadForm();

        if (Yii::$app->request->post()) {
            $file->imageFiles= [UploadedFile::getInstance($file, 'imageFiles')];
            $model['name'] = '/' . $file->imageFiles[0]->name;

            if ($model->save() && $file->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'file' => $file,
        ]);
    }

    /**
     * Updates an existing SvgIcons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = new UploadForm();

        if (Yii::$app->request->post()) {
            $file->imageFiles = [UploadedFile::getInstance($file, 'imageFiles')];
            $model['name'] = '/' . $file->imageFiles[0]->name;

            if ($model->save() && $file->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'file' => $file,
        ]);
    }

    /**
     * Deletes an existing SvgIcons model.
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
     * Finds the SvgIcons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SvgIcons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SvgIcons::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
