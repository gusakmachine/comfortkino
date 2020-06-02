<?php
namespace backend\widgets\AllowedBackgroundColorsViewer;

use common\models\ads\AllowedBackgroundColors;
use common\models\Colors;
use yii\base\Widget;

class AllowedBackgroundColorsViewer extends Widget
{
    public $input_id;
    public $current_color;

    public function run() {
        $model = Colors::find()->where(['id' => AllowedBackgroundColors::find()->asArray()->all()])->asArray()->all();

        return $this->render('index', [
            'current_color' => $this->current_color,
            'input_id' => $this->input_id,
            'model' => $model,
        ]);
    }
}