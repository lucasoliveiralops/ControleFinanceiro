<?php 

namespace App\Lib;
class Alert {
  private static $alertTypes = array(
    'success' => 'alert-success', 
    'warning' => 'alert-warning',
    'error'  => 'alert-danger',
    'info'    => 'alert-info',
  );

  static function alert($type, $message)
  {
    if(isset(self::$alertTypes[$type])){
      return '<div class="alert ' . self::$alertTypes[$type] .'" role="alert">'
      . $message 
      . '</div>';
    }
    throw new \Exception('Tipo de alerta inexistente!');
  }
}
