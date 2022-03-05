<?php 

namespace App\Model;

class Login  {
    use Model;
    public function verifyCredentials($email, $password){
      $db = $this->toConnection;
      $db->where('login_usuario', $email);
      $db->where('senha_usuario', $password);
      $user = $db->get('usuarios');
      if(!empty($user)){
        return $this->transformInItem($user);
      }
    }

}
