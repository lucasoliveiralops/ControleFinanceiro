<?php

namespace App\Controller;

class Home extends Controller
{

  private $movementCtl;
  public function __construct()
  {
    $this->movementCtl = new \App\Controller\Movement();
  }

  public function index()
  {
    $this->appendCSS('homePage');
    $this->appendJS('homePage');
    $this->setTitle('Home');
    $this->data["categories"] = $this->getMovementCategories();
    $this->data['movements'] = $this->movementCtl->getAllMovementsOfThisMonth();
    if (!empty($_POST)) {
      $_POST['movementInstallments'] = !isset($_POST['movementInstallments']) ? '1' : $_POST['movementInstallments'];
      $this->movementCtl->insertMovementFromForm($_POST);
    }
    $this->renderTemplete('home/index');
  }

  private function getMovementCategories(): array
  {
    $typeMovementCategoryModel = new \App\Model\TypeMovementCategory();
    $movementCategoryModel = new \App\Model\MovementCategory();
    $typeCategories = $typeMovementCategoryModel->getAll();
    $categories = array();
    foreach ($typeCategories as $key => $value) {
      $categories[$key]['idTypeCategory'] = $value->id;
      $categories[$key]['nameTypeCategory'] = $value->name;
      $categories[$key]['categories'] = $movementCategoryModel->getAllByIdTypeCategory($value->id);
    }
    return $categories;
  }
}
