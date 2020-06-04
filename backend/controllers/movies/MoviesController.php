<?php

namespace backend\controllers\movies;

use common\models\movies\Actors;
use common\models\movies\Countries;
use common\models\movies\Directors;
use common\models\movies\Gallery;
use common\models\movies\Genres;
use common\models\movies\MoviesActors;
use common\models\movies\MoviesCountries;
use common\models\movies\MoviesDirectors;
use common\models\movies\MoviesGenres;
use common\models\UploadForm;
use Yii;
use common\models\movies\Movies;
use common\models\movies\SearchMovies;
use yii\base\Model;
use yii\helpers\ArrayHelper;
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

    public static function controllerName() {
        return 'Фильмы';
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
            //Upload images
            $files->imageFiles['poster'] = UploadedFile::getInstances($model, 'file_poster');
            $files->imageFiles['mob_poster'] = UploadedFile::getInstances($model, 'file_mob_poster');
            $files->imageFiles['gallery'] = UploadedFile::getInstances($model, 'files_gallery');

            if (!empty($files->imageFiles['poster']))
                $model['poster'] = $files->imageFiles['poster'][0]->name;
            if (!empty($files->imageFiles['mob_poster']))
                $model['mob_poster'] = $files->imageFiles['mob_poster'][0]->name;

            if ($model->save() && $files->upload()) {
                //Upload actors, directors, genres, countries, gallery
                $new_actors = MoviesActors::loadActors($model->id, Yii::$app->request->post()['Movies']['actors']);
                $new_directors = MoviesDirectors::loadDirectors($model->id, Yii::$app->request->post()['Movies']['directors']);
                $new_genres = MoviesGenres::loadGenres($model->id, Yii::$app->request->post()['Movies']['genres']);
                $new_countries = MoviesCountries::loadCountries($model->id, Yii::$app->request->post()['Movies']['countries']);
                $new_gallery_models = Gallery::loadImageFiles($model->id, $files->imageFiles['gallery']);

                if (MoviesActors::saveMultiple($new_actors)
                    && MoviesDirectors::saveMultiple($new_directors)
                    && MoviesGenres::saveMultiple($new_genres)
                    && MoviesCountries::saveMultiple($new_countries)
                    && Gallery::saveMultiple($new_gallery_models)
                )
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'actors' => ArrayHelper::map(Actors::find()->asArray()->all(), 'id', 'name'),
            'directors' => ArrayHelper::map(Directors::find()->asArray()->all(), 'id', 'name'),
            'genres' => ArrayHelper::map(Genres::find()->asArray()->all(), 'id', 'name'),
            'countries' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
            'gallery' => $model->getGallery()->asArray()->all(),
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
        $files = new UploadForm();
        $gallery_models = Gallery::find()->where(['movies_id' => $id])->all();

        $model->actors = $model->getActors()->all();
        $model->directors = $model->getDirectors()->all();
        $model->genres = $model->getGenres()->all();
        $model->countries = $model->getCountries()->all();

        if ($model->load(Yii::$app->request->post())) {
            //Upload images
            $files->imageFiles['poster'] = UploadedFile::getInstances($model, 'file_poster');
            $files->imageFiles['mob_poster'] = UploadedFile::getInstances($model, 'file_mob_poster');
            $files->imageFiles['gallery'] = UploadedFile::getInstances($model, 'files_gallery');

            if (!empty($files->imageFiles['poster']))
                $model['poster'] = $files->imageFiles['poster'][0]->name;
            if (!empty($files->imageFiles['mob_poster']))
                $model['mob_poster'] = $files->imageFiles['mob_poster'][0]->name;

            $new_gallery_models = Gallery::loadImageFiles($id, $files->imageFiles['gallery'], $gallery_models);

            if(isset(Yii::$app->request->post()['to_delete_gallery_images']))
                Gallery::deleteImageFiles($gallery_models, Yii::$app->request->post()['to_delete_gallery_images']);

            //Upload actors, directors, genres, countries
            MoviesActors::deleteAll('movies_id = :movies_id', [':movies_id' => $id]);
            MoviesDirectors::deleteAll('movies_id = :movies_id', [':movies_id' => $id]);
            MoviesGenres::deleteAll('movies_id = :movies_id', [':movies_id' => $id]);
            MoviesCountries::deleteAll('movies_id = :movies_id', [':movies_id' => $id]);

            $new_actors = MoviesActors::loadActors($id, Yii::$app->request->post()['Movies']['actors']);
            $new_directors = MoviesDirectors::loadDirectors($id, Yii::$app->request->post()['Movies']['directors']);
            $new_genres = MoviesGenres::loadGenres($id, Yii::$app->request->post()['Movies']['genres']);
            $new_countries = MoviesCountries::loadCountries($id, Yii::$app->request->post()['Movies']['countries']);

            if ($model->save()
                && $files->upload()
                && Gallery::saveMultiple($new_gallery_models)
                && MoviesActors::saveMultiple($new_actors)
                && MoviesDirectors::saveMultiple($new_directors)
                && MoviesGenres::saveMultiple($new_genres)
                && MoviesCountries::saveMultiple($new_countries)
            )
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'actors' => ArrayHelper::map(Actors::find()->asArray()->all(), 'id', 'name'),
            'directors' => ArrayHelper::map(Directors::find()->asArray()->all(), 'id', 'name'),
            'genres' => ArrayHelper::map(Genres::find()->asArray()->all(), 'id', 'name'),
            'countries' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
            'gallery' => $model->getGallery()->asArray()->all(),
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
