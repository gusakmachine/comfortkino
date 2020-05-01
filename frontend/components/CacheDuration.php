<?php

namespace frontend\components;

class CacheDuration
{
    public static function getSecondsToMidnight($midnightDate)
    {
        $midnightDate = date_parse($midnightDate);
        $sec = (
            mktime(0,0,0,$midnightDate['month'], $midnightDate['day'] + 1, $midnightDate['year'])
            -
            mktime(0,0,0, date('m'), date('d'), date('Y'))
        );

        return $sec - (date('H') * 3600 + date('i') * 60 + date('s'));
    }
}