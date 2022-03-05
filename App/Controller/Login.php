<?php 

namespace App\Controller;

class Login extends Controller{

  public function index()
  {
    if(\App\Lib\Session::getInstanse()->isAuthenticatedUser()){
      \App\Lib\Redirect::internalRedirect('home');
    }
    $this->titlePage = 'Login';
    $this->justMiddle = true;
    $this->data['msg'] = $this->logInSystem();
    $this->renderTemplete('login');
  }

  public function logout(){
    session_destroy();
    \App\Lib\Redirect::internalRedirect('login');
  }

  private function logInSystem(){
    if(!empty($_POST)){
        $encryptedPassword = sha1($_POST['password']);
        $user = $this->model->verifyCredentials($_POST['email'],  $encryptedPassword);
          if(!empty($user)){
            \App\Lib\Session::getInstanse()->setUserInformation($user);
            \App\Lib\Redirect::internalRedirect('home');
          }
          return \App\Lib\Alert::alert('error', 'Usuário ou senha inválido!');
      }
  }

}