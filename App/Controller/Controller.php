<?php 

namespace App\Controller;

class Controller {

  protected $data, $output, $nameTemplate, $titlePage, $justMiddle = false, $model;

  public function __construct(){
    $class = '\App\Model\\' . str_replace('App\Controller\\', '', get_class($this));
    if(class_exists($class)){
      $this->model = new $class();
    }
  }
  protected function getTemplateWithRightPath($templete){
    return "View\\" . $templete . '.php';
  }

  private function getTitlePage(){
    if(empty($this->titlePage)){
      return '';
    }
    return $this->titlePage . ' | ';
  }

  public function header()
  {
  }

  public function home()
  {
    $this->titlePage = 'Home';
    $this->nameTemplate = 'home/index';
    $this->renderTemplete('home/index');
  }

  public function footer()
  {
    echo 'eu sou um footer';
  }

  public function notFound(){
    $this->titlePage = '404';
    $this->nameTemplate = 'home';
    $this->renderTemplete('404');
  }
  
  public function renderTemplete($viewTemplete)
  {
    $template = $this->getTemplateWithRightPath($viewTemplete);
    if (!file_exists($template)) {
        throw new \Exception('Error: Não foi possivel encontrar a view "' . $this->nameTemplate . '"!');
    }
    $this->data['titlePage'] = $this->getTitlePage();
    if($this->justMiddle == false) {
      $this->header();
    }
    ob_start();
    extract($this->data);
    if($this->justMiddle == false) {
      require($this->getTemplateWithRightPath('header'));
    }
    require($template);
    if($this->justMiddle == false) {
      require($this->getTemplateWithRightPath('footer'));
    }
    $this->data = ob_get_contents();
    $this->data = preg_replace("/\s\s+/", ' ', str_replace("\n", '', $this->data));
    return $this->data;
  }
}
