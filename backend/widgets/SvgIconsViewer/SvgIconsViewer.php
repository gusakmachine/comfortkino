<?php
namespace backend\widgets\SvgIconsViewer;

use yii\base\Widget;

use common\models\SvgIcons;

class SvgIconsViewer extends Widget
{
    public $element_name;
    public $name;

    public function run()
    {
        return $this->render('index', [
            'svgIcons' => SvgIcons::find()->asArray()->all(),
            'element_name' => $this->element_name,
            'name' => $this->name
        ]);
    }
}