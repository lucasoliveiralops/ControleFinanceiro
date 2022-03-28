<?php

namespace App\Model;

class MovementCategoryMap
{
  use Mapper;
  private function setItensOfMap()
  {
    $this->appendMap('id_categoria_movimentacao', 'id');
    $this->appendMap('nome_categoria_movimentacao', 'name');
    $this->appendMap('fk_id_tipo_categoria_movimentacao', 'idTypeCategory');
    $this->appendMap('nome_tipo_categoria_movimentacao', 'nameTypeCategory');
  }
}
