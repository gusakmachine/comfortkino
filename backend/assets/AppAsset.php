<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/jquery-ui/jquery-ui.min.css',
        'css/jquery-ui/jquery-ui.structure.min.css',
        'css/jquery-ui/jquery-ui.theme.min.css',
    ];
    public $js = [
        'js/jquery-ui/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
