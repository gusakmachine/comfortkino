<?php

namespace backend\controllers\theaters;

use common\models\theaters\Cities;
use common\models\theaters\CitiesSearch;
use common\models\theaters\MovieTheatersSearch;
use common\models\theaters\PhoneNumbers;
use common\models\theaters\Socials;
use common\models\UploadForm;
use Yii;
use common\models\theaters\MovieTheaters;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MovieTheatersController implements the CRUD actions for MovieTheaters model.
 */
class MovieTheatersController extends Controller
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
        return 'Кинотеатры';
    }

    /**
     * Lists all MovieTheaters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovieTheatersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MovieTheaters model.
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
     * Creates a new MovieTheaters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $movieTheaters = new MovieTheaters();
        $socials = new Socials();
        $phones = [new PhoneNumbers()];
        $cities = Cities::find()->asArray()->all();
        $file = new UploadForm();

        if (Yii::$app->request->isPost) {
            $formData = Yii::$app->request->post();
            $phones = $this->preparePhonesArray(Yii::$app->request->post('PhoneNumbers', []), $phones);
            if ($movieTheaters->load($formData) && $socials->load($formData) && PhoneNumbers::loadMultiple($phones, $formData)) {
                $file->dirname = Yii::getAlias('@map_img/');
                $file->imageFiles = [UploadedFile::getInstance($file, 'imageFiles')];
                $movieTheaters->google_map_img = '/' . $file->imageFiles[0]->name;
                if ($movieTheaters->validate() && $socials->validate() && PhoneNumbers::validateMultiple($phones)) {
                    if ($movieTheaters->save() && $socials->save($movieTheaters->id) && $file->upload() && PhoneNumbers::saveMultiple($phones,  $movieTheaters->id)) {
                        return $this->redirect(['view', 'id' => $movieTheaters->id]);
                    }
                }
            }
        }

        return $this->render('create', [
            'movieTheaters' => $movieTheaters,
            'socials' => $socials,
            'phones' => $phones,
            'cities' => ArrayHelper::map($cities, 'id', 'name'),
            'file' => $file,
        ]);
    }

    /**
     * Updates an existing MovieTheaters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $movieTheaters = $this->findModel($id);
        $socials = Socials::find()->where(['movie_theaters_id' => $id])->one();
        $phones = $this->getPhonesByMovieTheatersId($id);
        $cities = Cities::find()->asArray()->all();
        $file = new UploadForm();

        if (Yii::$app->request->isPost) {
            $formData = Yii::$app->request->post();
            PhoneNumbers::deleteAll('movie_theaters_id = :movie_theaters_id', [':movie_theaters_id' => $id]);
            $phones = $this->preparePhonesArray(Yii::$app->request->post('PhoneNumbers', []));
            if ($movieTheaters->load(Yii::$app->request->post()) && $socials->load($formData) && PhoneNumbers::loadMultiple($phones, $formData)) {
                $file->dirname = Yii::getAlias('@map_img/');
                $file->imageFiles = [UploadedFile::getInstance($file, 'imageFiles')];
                $movieTheaters->google_map_img = '/' . $file->imageFiles[0]->name;
                if ($movieTheaters->validate() && $socials->validate() && PhoneNumbers::validateMultiple($phones)) {
                    if ($movieTheaters->save() && $socials->save($id) && $file->upload() && PhoneNumbers::saveMultiple($phones, $id)) {
                        return $this->redirect(['view', 'id' => $id]);
                    }
                }
            }
        }

        return $this->render('update', [
            'movieTheaters' => $movieTheaters,
            'socials' => $socials,
            'phones' => $phones,
            'cities' => ArrayHelper::map($cities, 'id', 'name'),
            'file' => $file,
        ]);
    }

    /**
     * Deletes an existing MovieTheaters model.
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
     * Finds the MovieTheaters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MovieTheaters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MovieTheaters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return array
     */
    private function getPhonesByMovieTheatersId($id)
    {
        $data = PhoneNumbers::find()->where(['movie_theaters_id' => $id])->asArray()->all();
        $items = [];
        foreach ($data as $row) {
            $item = new PhoneNumbers();
            $item->setAttributes($row);
            $items[] = $item;
        }
        return $items;
    }

    /**
     * @param $times
     * @return mixed
     */
    private function preparePhonesArray($formData, $phones = []) {
        foreach (array_keys($formData) as $index) {
            $phones[$index] = new PhoneNumbers();
        }
        return $phones;
    }
}
