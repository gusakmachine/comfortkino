<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $css = [
        'css/modules/reset.css',
        'css/modules/helper.css',
        'css/main.css',
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/pages/index.js',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
}

