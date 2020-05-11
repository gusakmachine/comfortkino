<?php

namespace frontend\components;

use Yii;
use yii\base\Model;

class MovieTheater extends Model
{
    public static function generateDayList($date, $sessions)
    {
        $dayList = [];

        if ($sessions) {
            $length = (
                    strtotime($sessions[count($sessions) - 1]['date']) //get last session date
                    - strtotime(date('Y-m-d', strtotime('- 1 day'))) //get yesterday day ('- 1 day' - count today)
                ) / (60 * 60 * 24); //get difference in days
        } else $length = 0;
        $minLengthDayList = 9; //week + this day + 1 because for ($i < 9) so max $i == 8

        if ($length < $minLengthDayList)
            $length = $minLengthDayList;

        $date = date_parse($date);

        for ($i = 0, $j = 0; $i < $length; $i++) {
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

            $dayList['date'][$i] = [
                'Y-m-d' => date('Y-m-d', strtotime('+ '. $i .' day')),
                'day-of-week' => mb_strtoupper(mb_substr($day_of_week, 0, 1, 'utf-8'), 'utf-8') . mb_substr($day_of_week, 1, strlen($day_of_week), 'utf-8'),
                'month' => Yii::$app->formatter->asDate($date['month'] + strtotime("+" . $i . " day"), 'MMMM'),
                'day' => Yii::$app->formatter->asDate($date['day'] + strtotime("+" . $i . " day"), 'dd'),
            ];

            if (isset($sessions[$j]) && $dayList['date'][$i]['Y-m-d'] == $sessions[$j]['date']) {
                $dayList['empty_day'][$i] = true;
                $j++;
            } else $dayList['empty_day'][$i] = false;
        }

        return $dayList;
    }
}