<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class FilmAsset extends AssetBundle
{
    public $css = [
        'css/modules/owl.theme.default.min.css',
        'css/modules/owl.carousel.min.css',
        'css/film.css',
        'css/popup.css',
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/pages/film.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}


