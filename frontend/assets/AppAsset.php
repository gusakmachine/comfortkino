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
        'css/fonts/fonts.css',
        'css/modules/owl.theme.default.min.css',
        'css/modules/owl.carousel.min.css',
        'css/modules/popup.css',
        'css/modules/magnific-popup.css',
        'css/main.css',
        'css/index.css',
    ];
    public $js = [
        'js/drag-scroll.js',
        'js/jquery.magnific-popup.min.js',
        'js/owl.carousel.min.js',
        'js/show-hide.js',
        'js/popup-tickets.js',
        'js/popup-cities.js',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
}

