<?php
namespace backend\components;

use yii\web\Controller as BaseController;

class Controller extends BaseController
{
    public $pages;

    public function beforeAction($action)
    {
        $this->pages = [
            'Объявления' => [
                'Заметки' => '/ads/notes',
                'Бренд-заметки' => '/ads/branding-notes',
                'Карусель-объявления' => '/ads/owl-ads',
                'Карусель-фильмы' => '/ads/owl-movies',
                'Фон' => '/ads/page-background',
            ],
            'Фильмы' => [
                'Актёры' => '/movies/actors',
                'Страны' => '/movies/countries',
                'Режисёры' => '/movies/directors',
                'Жанры' => '/movies/genres',
                'Фильмы' => '/movies/movies',
            ],
            'Кинотеатры' => [
                'Города' => '/theaters/cities',
                'Кинотеатры' => '/theaters/movie-theaters',
                'Кинозалы' => '/theaters/halls',
                'Цены на места' => '/theaters/place-prices',
            ],
            'Сеансы' => [
                'Сеансы' => '/sessions/sessions',
                'Билеты' => '/sessions/tickets',
                'Неподтвержденные билеты' => '/sessions/tickets/unconfirmed',
            ],
            'Цвета' => '/colors',
            'Значки' => '/svg-icons',
            'Главная' => '/site',
        ];

        return parent::beforeAction($action);
    }
}