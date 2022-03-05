<?php 

namespace App\Model;

class LoginMap  {
    use Mapper;
    private function setItensOfMap()
    {
        $this->appendMap('id_usuario', 'id');
        $this->appendMap('nome_usuario', 'name');
        $this->appendMap('login_usuario', 'login');
    }

}
