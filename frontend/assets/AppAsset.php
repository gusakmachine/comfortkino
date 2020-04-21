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
        'css/modules/popup.css',
        'css/main.css',
    ];
    public $js = [
        'js/drag-scroll.js',
        'js/show-hide.js',
        'js/popup-tickets.js',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
}

