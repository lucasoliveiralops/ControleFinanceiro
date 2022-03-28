<?php

namespace App\Lib;

class Date
{
  static function todayDateForInput()
  {
    return date("Y-m-d");
  }

  static function firstDayOfTheMonth()
  {
    return date("Y-m-01");
  }

  static function lastDayOfTheMonth()
  {
    return date("Y-m-t");
  }

  static function formatDate($date)
  {
    return date('d/m/Y', strtotime($date));
  }
}
