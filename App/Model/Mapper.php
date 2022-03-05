<?php

namespace App\Model;

trait Mapper {

    private $data;
    protected $map = array();

    abstract function setItensOfMap();
    
    public function getMap() {
        return $this->map;
    }

    public function __construct($register = null) {
      $this->setItensOfMap();
      $this->setData($register);
    }
    private function appendMap($fieldInDb, $newName) {
        $this->map[$newName] = array(
            'fieldInDb' => $fieldInDb,
        );
    }

    private function setData($register){
      foreach($this->map as $newName => $fieldInDb){
        if(isset($fieldInDb['fieldInDb'])){
          $this->data[$newName] = $register[$fieldInDb['fieldInDb']];
        } else {
          $this->data[$newName] = '';
        }
      }
    }

    public function __get($field){
        return $this->data[$field];
    }

    public function __set($key, $value) {
      return $this->data[$key] = $value;
  }
}
