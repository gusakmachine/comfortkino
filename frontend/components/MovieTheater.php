<?php

namespace frontend\components;

use Yii;
use yii\base\Model;

class MovieTheater extends Model
{
    public static function generateDayList($length, $date)
    {
        $dayList = [];

        $date = date_parse($date);

        for ($i = 0; $i < $length; $i++) {
            switch ($i) {
                case 0:
                    $day_of_week = 'Сегодня';
                    break;
                case 1:
                    $day_of_week = 'Завтра';
                    break;
                default:
                    $day_of_week = Yii::$app->formatter->asDate(mktime(0, 0, 0, $date['month'], $date['day'] + $i, $date['year']), 'eeee');

            }

            $dayList[$i] = [
                'Y-m-d' => date('Y-m-d', strtotime('+ '. $i .' day')),
                'day-of-week' => mb_strtoupper(mb_substr($day_of_week, 0, 1, 'utf-8'), 'utf-8') . mb_substr($day_of_week, 1, strlen($day_of_week), 'utf-8'),
                'month' => Yii::$app->formatter->asDate($date['month'] + strtotime("+" . $i . " day"), 'MMMM'),
                'day' => Yii::$app->formatter->asDate($date['day'] + strtotime("+" . $i . " day"), 'dd'),
            ];
        }

        return $dayList;
    }
}