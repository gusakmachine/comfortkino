<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $css = [
        'css/index.css',
    ];
    public $js = [
        'js/pages/index.js',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
}





