<?php

namespace App\Lib;

class GeneretePage
{
  static function generete($path, $data)
  {
    ob_start();
    $data = $data;
    require_once($path);
    return ob_get_clean();
  }
}
