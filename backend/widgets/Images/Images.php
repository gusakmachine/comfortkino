<?php
namespace backend\widgets\Images;

use yii\base\Widget;

class Images extends Widget
{
    public $name;
    public $input_id;
    public $model;
    public $images_path;

    public function run()
    {
        return $this->render('index', [
            'name' => $this->name,
            'input_id' => $this->input_id,
            'model' => $this->model->find()->asArray()->all(),
            'images_path' => $this->images_path
        ]);
    }
}