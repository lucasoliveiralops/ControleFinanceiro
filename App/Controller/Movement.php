<?php

namespace App\Controller;

use \App\Lib\{
  Alert,
  Date,
  Validations\ValidationsForm
};

class Movement extends Controller
{
  public function insertMovementFromForm(array $values)
  {
    try {
      $this->validateInsertFrom($values);
      if (isset($values['Parcelas']) && $values['Parcelas'] > 1) {
        return $this->insertMovementWithInstallmentsForm($values);
      }
      return $this->insertSimpleMovement($values);
    } catch (\Exception $e) {
      return Alert::alert('error', $e->getMessage());
    }
  }

  private function insertSimpleMovement(array $movement)
  {
    $this->model->insert($movement);
    return Alert::alert('success', 'Movimentação inserida com sucesso!');
  }
  private function insertMovementWithInstallmentsForm(array $movement)
  {
    $idMainMovement = $this->model->insert($movement);
    for ($installment = 1; $installment < $movement['Parcelas']; $installment++) {
      $movementInstallments = $movement;
      $date = strtotime($movement['Data']);
      $nameMovement = $movement['Nome'] . ' ' . $installment + 1 . '/' .  $movement['Parcelas'];
      $movementInstallments['Nome'] = $nameMovement;
      $movementInstallments['id_pai_movimentacao'] = $idMainMovement;
      $movementInstallments['Data'] = date("Y-m-d", strtotime("+1 month", $date));
      $this->model->insert($movementInstallments);
    }
    return Alert::alert('success', 'Movimentação inserida com sucesso!');
  }
  private function validateInsertFrom(array $values)
  {
    $validation = new ValidationsForm();
    $validation->setItemsForValidation($values);
    $validation->setListValidations(
      array(
        array('Nome', 'minLenght[5]'),
        array('Valor', 'numeric, required'),
        array('Parcelas', 'numeric'),
        array('typeMoviment', 'numeric'),
        array('Categoria', 'numeric'),
      )
    );
    if ($validation->isValid()) {
      return true;
    }
    $errors = implode('<br>', $validation->getErrors());
    throw new \Exception($errors);
  }

  public function getAllMovementsOfThisMonth()
  {
    $firstDate = Date::firstDayOfTheMonth();
    $lastDate = Date::lastDayOfTheMonth();
    return $this->model->getAllBetweenDate($firstDate, $lastDate);
  }
}
