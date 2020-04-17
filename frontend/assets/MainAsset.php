<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $css = [
        'css/modules/owl.theme.default.min.css',
        'css/modules/owl.carousel.min.css',
        'css/index.css',
        'css/popup.css',
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/pages/main.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}


