<?php

namespace App\Lib;

class Redirect
{
  static function internalRedirect($url)
  {
    header('Location: ' . URL_BASE . $url);
    exit();
  }
}
