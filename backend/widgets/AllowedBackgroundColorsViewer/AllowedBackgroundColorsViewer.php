<?php
namespace backend\widgets\AllowedBackgroundColorsViewer;

use yii\base\Widget;

use common\models\AllowedBackgroundColors;

class AllowedBackgroundColorsViewer extends Widget
{
    public $name;
    public $element_name;

    public function run()
    {
        return $this->render('index', [
            'model' => AllowedBackgroundColors::find()->asArray()->all(),
            'element_name' => $this->element_name,
            'name' => $this->name
        ]);
    }
}