<?php 

namespace App\Model;

class Connection {
    public function getConnection(){
      return new \MysqliDb (Array (
        'host' => 'localhost',
        'username' => 'root', 
        'password' => '',
        'db'=> 'controle_financeiro',
        'port' => 3306,
        'charset' => 'utf8'));
    }
}
