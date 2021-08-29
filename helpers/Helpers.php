<?php

use Carbon\Carbon;

function calculateArrivalInUTC($earthTime): Carbon
{
    $start = new \Carbon\Carbon($earthTime);
    $warehouseToEarthDays = config('custom.courier_time_in_days.warehouse_to_earth_station');
    $earthToLunarDays = config('custom.courier_time_in_days.earth_to_lunar_colony');
    $totalCourierDays = $warehouseToEarthDays + $earthToLunarDays;
    return $start->addDays($totalCourierDays);
}

function convertUTCToLST($time): string
{
    $lunarSecond = 0.984352966667; // 1 Lunar second is 0.9843529666671 second on Earth
    $lunarTotalSeconds = 31104000; // 60 * 60 * 24 * 30 * 12
    $dayToSeconds = 86400; // 24 * 60 * 60
    $monthToSeconds = 2592000; // 30 * 24 * 60 * 60
    $formatString = config('custom.lunar_time_format');
    $lunarTimestamp = abs(strtotime('1969-07-21 02:56:15'));

    $start = new \Carbon\Carbon($time);
    $timestamp = $start->timestamp;
    $timeStampSinceLunar = $timestamp + $lunarTimestamp;
    $lunarTime = (int)($timeStampSinceLunar / $lunarSecond);
    $years = floor($lunarTime / ($lunarTotalSeconds)) + 1;
    $days = floor($lunarTime % ($lunarTotalSeconds) / ($monthToSeconds)) + 1;
    $cycles = floor($lunarTime % ($monthToSeconds) / ($dayToSeconds)) + 1;
    $hours = floor($lunarTime % ($dayToSeconds) / 3600);
    $minutes = floor($lunarTime % (60 * 60) / 60);
    $seconds = floor($lunarTime % (60));

    return $years.'-'.$days.'-'.$cycles. ' ∇  '.$hours.':'.$minutes.':'.$seconds; 
}
