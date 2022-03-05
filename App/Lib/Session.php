<?php 

namespace App\Lib;
class Session {

  private static $instance, $baseSession = 'App';
  
  public static function getInstanse(){
    if( self::$instance == null){
      self::$instance = new Session();
    }
    return self::$instance;
  }
  public function setUserInformation($informations){
    $groupSession = 'User';
    $this->set('id', $informations->id, $groupSession);
    $this->set('name', $informations->name, $groupSession);
    $this->set('login', $informations->login, $groupSession);
  }
  public function set($nameSession, $valueSession, $groupSession = ''){
    if(!empty($groupSession)){
      $_SESSION[self::$baseSession][$groupSession][$nameSession] = $valueSession;
    } else{
      $_SESSION[self::$baseSession][$nameSession] = $valueSession;
    }
  }

  public function get($nameSession, $groupSession = ''){
    if(!empty($groupSession)){
      return $_SESSION[self::$baseSession][$groupSession][$nameSession];
    }
    return $_SESSION[self::$baseSession][$nameSession];
  }
  public function isAuthenticatedUser(){
    if(!empty($_SESSION['App']['User'])){
      return true;
    }
    return false;
  }
}
