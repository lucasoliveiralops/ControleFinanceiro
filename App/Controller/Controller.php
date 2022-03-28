<?php

namespace App\Controller;

class Controller
{

  protected $data, $output, $nameTemplate;
  protected $titlePage, $model, $header;
  public $justMiddle = false;

  public function __construct()
  {
    $class = '\App\Model\\' . str_replace('App\Controller\\', '', get_class($this));
    if (class_exists($class)) {
      $this->model = new $class();
    }
  }
  protected function getTemplateWithRightPath($templete)
  {
    return "View\\" . $templete . '.php';
  }

  public function getTitlePage()
  {
    if (empty($this->titlePage)) {
      return '';
    }
    return $this->titlePage . ' | ';
  }

  public function getOutput()
  {
    return $this->output;
  }

  protected function appendJS($js)
  {
    \App\Lib\HeaderAndFooter::getInstanse()->addJS($js);
  }

  protected function appendCSS($css)
  {
    \App\Lib\HeaderAndFooter::getInstanse()->addStyle($css);
  }
  public function renderTemplete($viewTemplete)
  {
    $template = $this->getTemplateWithRightPath($viewTemplete);
    if (!file_exists($template)) {
      throw new \Exception('Error: Não foi possivel encontrar a view "' . $template . '"!');
    }
    $this->data['titlePage'] = \App\Lib\HeaderAndFooter::getInstanse()->getTitle();
    if (is_array($this->data)) {
      extract($this->data);
    }
    ob_start();
    require($template);
    $this->output = ob_get_clean();
    $this->output = preg_replace("/\s\s+/", ' ', str_replace("\n", '', $this->output));
    return $this->output;
  }

  protected function setTitle($title)
  {
    \App\Lib\HeaderAndFooter::getInstanse()->setTitle($title);
  }
}
