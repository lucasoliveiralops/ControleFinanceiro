<?php

namespace App\Controller;

use \App\Lib\{
  GeneretePage,
  Json,
  Date
};

class Home extends Controller
{

  private $movementCtl, $movementsModel;
  public function __construct()
  {
    $this->movementCtl = new \App\Controller\Movement();
    $this->movementsModel = new \App\Model\Movement();
  }

  public function index()
  {
    $this->appendCSS('homePage');
    $this->appendJS('homePage');
    $this->setTitle('Home');
    $this->data["categories"] = $this->getMovementCategories();
    $this->renderTemplete('home/index');
  }

  public function genereteTableMovementsOfThisMonthAjax()
  {
    $movements = $this->movementCtl->getAllMovementsOfThisMonth();
    $contentPage = GeneretePage::generete('View/home/listMovements.php', $movements);
    echo Json::encode(array(
      'html' => $contentPage
    ));
  }

  public function getAllOutgoingMovementsOfThisMonthAjax()
  {
    $firstDayOfTheMonth = Date::firstDayOfTheMonth();
    $lastDayOfTheMonth = Date::lastDayOfTheMonth();
    echo Json::encode(array(
      'value' => $this->movementsModel->getSumValuesByTypeTransactionAndBetwennDate(
        $firstDayOfTheMonth,
        $lastDayOfTheMonth,
        $this->movementCtl->typeMovementsOutgoing
      )
    ));
  }

  public function getAllOutgoingMovementsOfThisWeekAjax()
  {
    $firstDayOfThisWeek = Date::firstDayOfTheWeek();
    $lastDayOfThisWeek = Date::lastDayOfTheWeek();
    echo Json::encode(array(
      'value' => $this->movementsModel->getSumValuesByTypeTransactionAndBetwennDate(
        $firstDayOfThisWeek,
        $lastDayOfThisWeek,
        $this->movementCtl->typeMovementsOutgoing
      )
    ));
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
