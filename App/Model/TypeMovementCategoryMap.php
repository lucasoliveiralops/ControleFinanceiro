<?php

namespace App\Model;

class TypeMovementCategoryMap
{
  use Mapper;
  private function setItensOfMap()
  {
    $this->appendMap('id_tipo_categoria_movimentacao', 'id');
    $this->appendMap('nome_tipo_categoria_movimentacao', 'name');
  }
}
