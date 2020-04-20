<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $css = [
        'css/modules/owl.theme.default.min.css',
        'css/modules/owl.carousel.min.css',
        'css/modules/popup.css',
        'css/index.css',
    ];
    public $js = [
        'js/drag-scroll.js',
        'js/show-hide.js',
        'js/popup-tickets.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}





