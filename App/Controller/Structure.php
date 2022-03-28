<?php

namespace App\Controller;

class Structure extends Controller
{

  public function headerPage()
  {
    $this->renderTemplete('header');
  }

  public function footerPage()
  {
    $this->renderTemplete('footer');
  }

  public function notFound()
  {
    $this->justMiddle = true;
    $this->titlePage = '404';
    $this->appendCSS('404Page');
    $this->renderTemplete('404');
  }
}
