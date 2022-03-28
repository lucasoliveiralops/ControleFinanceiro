<?php

namespace App\Model;

class TypeMovementCategory
{
  use Model;
  public function getById($id)
  {
    $db = $this->toConnection;
    $id = $db->escape($id);
    $db->where('id_tipo_categoria_movimentacao', $id);
    $movementCategory = $db->get('tipo_categoria_movimentacao');
    if (!empty($movementCategory)) {
      return $this->transformInItem($movementCategory);
    }
  }
  public function getAll()
  {
    $db = $this->toConnection;
    $movementCategory = $db->get('tipo_categoria_movimentacao');
    if (!empty($movementCategory)) {
      return $this->transformInList($movementCategory);
    }
  }
}
