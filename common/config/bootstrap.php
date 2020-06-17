<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@frontend_link', 'http://otrada.comfortkino.com/');

date_default_timezone_set('Europe/Moscow');

//image paths
Yii::setAlias('@gallery', '/img/gallery');
Yii::setAlias('@posters', '/img/posters');
Yii::setAlias('@mob_posters', '/img/mob_poster');
Yii::setAlias('@owl-backgrounds', '/img/ads/owl-backgrounds');
Yii::setAlias('@page-backgrounds', '/img/ads/page-backgrounds');
Yii::setAlias('@svg', '/img/svg/');
Yii::setAlias('@static_svg_icons', '/img/static');
Yii::setAlias('@map_img', Yii::getAlias('@static_svg_icons') . '/google_maps');

//Installing aliases for static images
Yii::setAlias('@logo-image', Yii::getAlias('@static_svg_icons') . '/logos/logo.png');

Yii::setAlias('@svg:#arrow-filled', Yii::getAlias('@static_svg_icons') . '/icons.svg#arrow-filled');
Yii::setAlias('@svg:#arrow-without-bottom', Yii::getAlias('@static_svg_icons') . '/icons.svg#arrow-without-bottom');
Yii::setAlias('@svg:#arrow-empty', Yii::getAlias('@static_svg_icons') . '/icons.svg#arrow-empty');
Yii::setAlias('@svg:#facebook', Yii::getAlias('@static_svg_icons') . '/icons.svg#facebook');
Yii::setAlias('@svg:#instagram', Yii::getAlias('@static_svg_icons') . '/icons.svg#instagram');
Yii::setAlias('@svg:#vk', Yii::getAlias('@static_svg_icons') . '/icons.svg#vk');
Yii::setAlias('@svg:#cross', Yii::getAlias('@static_svg_icons') . '/icons.svg#cross');

Yii::setAlias('@svg:place-logos', Yii::getAlias('@static_svg_icons') . '/logos/svg/place-logos.svg#otrada');