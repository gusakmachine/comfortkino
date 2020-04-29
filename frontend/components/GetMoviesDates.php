<?php

namespace frontend\components;

use Yii;

class GetMoviesDates
{
    public function getAllDates($length)
    {
        $days = [];

        for ($i = 0; $i < $length; $i++) {
            switch ($i) {
                case 0: $day_of_week = 'Сегодня';
                break;
                case 1: $day_of_week = 'Завтра';
                break;
                default:
                    $day_of_week = Yii::$app->formatter->asDate(mktime(0, 0, 0, 0, date('d') + $i, 0), 'eeee');
            }
            $days[$i] = [
                'day-of-week' => mb_strtoupper(mb_substr($day_of_week, 0, 1, 'utf-8'), 'utf-8') . mb_substr($day_of_week, 1, strlen($day_of_week), 'utf-8'),
                'month' => Yii::$app->formatter->asDate(date('F', strtotime("+" . $i . " day")), 'MMMM'),
                'day' => date('d', strtotime("+" . $i . " day")),
            ];
        }

        return $days;
    }
}