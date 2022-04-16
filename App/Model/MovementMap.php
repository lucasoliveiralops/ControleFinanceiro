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
    $this->appendMap('get_function_getNameStatusMovement', 'getNameStatusMovement');
    $this->appendMap('get_function_getNameTypeMovement', 'getTypeMovement');
    $this->appendMap('get_function_isDespesa', 'isDespesa');
    $this->appendMap('get_function_isDespesaFixa', 'isDespesaFixa');
    $this->appendMap('get_function_isGanho', 'isGanho');
    $this->appendMap('get_function_isGanhoFixo', 'isGanhoFixo');
  }
  private function isDespesa()
  {
    return $this->idTypeMovement == 2;
  }

  private function isDespesaFixa()
  {
    return $this->idTypeMovement == 4;
  }

  private function isGanho()
  {
    return $this->idTypeMovement == 1;
  }

  private function isGanhoFixo()
  {
    return $this->idTypeMovement == 3;
  }

  private function getTypeMovement()
  {
    if ($this->isGanho || $this->isGanhoFixo) {
      return 'Ganhos';
    }
    return 'Despesas';
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
      return 'Pago';
    }
    return 'Aberto';
  }
}
