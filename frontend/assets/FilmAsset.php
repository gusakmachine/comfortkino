<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class FilmAsset extends AssetBundle
{
    public $css = [
		'css/modules/magnific-popup.css',
        'css/film.css',
    ];
    public $js = [
		'js/jquery.magnific-popup.min.js',
        'js/pages/film.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}


