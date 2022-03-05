<?php 

namespace App\Lib;
class Redirect {
  static function internalRedirect($url)
  {
    header('Location: ' . $url);
		exit();
  }
}
