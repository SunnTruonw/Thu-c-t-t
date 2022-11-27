<?php

use Illuminate\Support\Arr;


function dateFormat($time = 0, $format = 'd/m/Y', $vietnam = true, $show_time = true, $type = 1)
{

    $days = array('Mon' => 'Thứ 2', 'Tue' => 'Thứ 3', 'Wed' => 'Thứ 4', 'Thu' => 'Thứ 5', 'Fri' => 'Thứ 6', 'Sat' => 'Thứ 7', 'Sun' => 'Chủ nhật');

    if ($time instanceof \DateTime) {
        return $time->format($format);
    }
    if (!is_int($time)) {
        $time = date_create($time)->getTimestamp();
    }
    $return = date($format, $time);
    if ($vietnam) {
        $return = ($show_time ? date('H:i - ', $time) : '') . $days[date('D', $time)] . ', ngày ' . date($format, $time);
    }
    return $return;
}

function show_minute_to_hour($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return '';
    }
    $hours   = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
