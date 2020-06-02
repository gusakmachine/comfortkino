<?php

namespace backend\controllers\movies;

use common\models\movies\Actors;
use common\models\movies\Gallery;
use common\models\UploadForm;
use Yii;
use common\models\movies\Movies;
use common\models\movies\SearchMovies;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MoviesController implements the CRUD actions for Movies model.
 */
class MoviesController extends Controller
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
     * Lists all Movies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchMovies();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Movies model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Movies::find()->with(['actors', 'genres', 'countries', 'directors', 'gallery'])->where(['id' => $id])->one(),
        ]);
    }

    /**
     * Creates a new Movies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Movies();
        $files = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $files->imageFiles = UploadedFile::getInstances($files, 'imageFile');

            $model['poster'] = (isset($files->imageFiles[0])) ? '/' . $model[$id] . '/' . $files->imageFiles[0]->name : '';
            $model['mob_poster'] = (isset($files->imageFiles[1])) ? '/' . $model[$id] . '/' . $files->imageFiles[1]->name : '';

            if ($model->save() && $files->upload())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'files' => $files,
        ]);
    }

    /**
     * Updates an existing Movies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $gallery_models = Gallery::find()->where(['movies_id' => $id])->all();
        $files = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $files->imageFiles['poster'] = UploadedFile::getInstances($model, 'file_poster');
            $files->imageFiles['mob_poster'] = UploadedFile::getInstances($model, 'file_mob_poster');
            $files->imageFiles['gallery'] = UploadedFile::getInstances($model, 'files_gallery');

            if (count($files->imageFiles['poster']) > 0)
                $model['poster'] = '/' . $id . '/' . $files->imageFiles['poster'][0]->name;
            if (count($files->imageFiles['mob_poster']) > 0)
                $model['mob_poster'] = '/' . $id . '/' . $files->imageFiles['mob_poster'][0]->name;

            $existing_gallery_names = Yii::$app->request->post();

            for ($i = 0; $i < count($gallery_models); $i++)
                if (boolval($existing_gallery_names['existing_gallery_names'][$i]) == false) {
                    $gallery_models[$i]->delete();
                }

            foreach ($files->imageFiles['gallery'] as $image) {
                foreach ($gallery_models as $gallery_model)
                    if ($gallery_model->path == '/' . $id . '/' . $image->name)
                        continue 2;

                $gallery_image = new Gallery();
                $gallery_image->path = '/' . $id . '/' . $image->name;
                $gallery_image->movies_id = $id;

                $gallery_models[] = $gallery_image;
            }

            if ($model->save() && $files->upload() && Gallery::saveMultiple($gallery_models))
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'actors' => implode(', ', array_column($model->getActors()->asArray()->all(), 'name')),
            'directors' => implode(', ', array_column($model->getDirectors()->asArray()->all(), 'name')),
            'genres' => implode(', ', array_column($model->getGenres()->asArray()->all(), 'name')),
            'countries' => implode(', ', array_column($model->getCountries()->asArray()->all(), 'name')),
            'gallery_paths' => $model->getGallery()->asArray()->all(),
        ]);
    }

    /**
     * Deletes an existing Movies model.
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
     * Finds the Movies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Movies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
