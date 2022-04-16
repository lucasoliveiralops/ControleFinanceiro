<?php

namespace App\Lib;

class Date
{
  static function todayDateForInput()
  {
    return date("Y-m-d");
  }

  static function firstDayOfTheWeek()
  {
    return date('Y-m-d', strtotime("sunday -1 week"));
  }

  static function firstDayOfTheMonth()
  {
    return date("Y-m-01");
  }

  static function lastDayOfTheMonth()
  {
    return date("Y-m-t");
  }

  static function lastDayOfTheWeek()
  {
    return date('Y-m-d', strtotime("sunday"));
  }


  static function formatDateBR($date)
  {
    return date('d/m/Y', strtotime($date));
  }
}
