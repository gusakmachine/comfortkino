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
        'js/pages/main.js',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
}

