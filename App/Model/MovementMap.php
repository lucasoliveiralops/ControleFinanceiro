<?php

namespace App\Model;

class MovementMap
{
  use Mapper;
  private function setItensOfMap()
  {
    $this->appendMap('id_movimentacao', 'id');
    $this->appendMap('nome_movimentacao', 'name');
    $this->appendMap('valor_movimentacao', 'value');
    $this->appendMap('date_movimentacao', 'date');
    $this->appendMap('status_movimentacao', 'status');
    $this->appendMap('fk_id_tipo_movimentacao', 'idTypeMovement');
    $this->appendMap('fk_id_categoria_movimentacao', 'idCategoryMovement');
    $this->appendMap('id_pai_movimentacao', 'idFatherMovement');
    $this->appendMap('get_function_getCategoryMovement', 'getCategoryMovement');
  }

  private function getCategoryMovement()
  {
    $movementCategory = new \App\Model\MovementCategory();
    $category = $movementCategory->getById($this->idCategoryMovement);
    return $category->name;
  }

  private function getNameStatusMovement()
  {
    if ($this->status == 1) {
      return 'Aberto';
    }
    return 'Pago';
  }
}
