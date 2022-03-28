<?php

namespace App\Model;

class MovementCategory
{
  use Model;
  public function getById($id)
  {
    $db = $this->toConnection;
    $id = $db->escape($id);
    $db->join("tipo_categoria_movimentacao", "id_tipo_categoria_movimentacao  = fk_id_tipo_categoria_movimentacao");
    $db->where('id_categoria_movimentacao', $id);
    $movementCategory = $db->get('categoria_movimentacao');
    if (!empty($movementCategory)) {
      return $this->transformInItem($movementCategory);
    }
  }
  public function getAll()
  {
    $db = $this->toConnection;
    $db->join("tipo_categoria_movimentacao", "id_tipo_categoria_movimentacao  = fk_id_tipo_categoria_movimentacao");
    $movementCategory = $db->get('categoria_movimentacao');
    if (!empty($movementCategory)) {
      return $this->transformInList($movementCategory);
    }
  }

  public function getAllByIdTypeCategory($id)
  {
    $db = $this->toConnection;
    $id = $db->escape($id);
    $db->join("tipo_categoria_movimentacao", "id_tipo_categoria_movimentacao  = fk_id_tipo_categoria_movimentacao");
    $db->where('fk_id_tipo_categoria_movimentacao', $id);
    $movementCategory = $db->get('categoria_movimentacao');
    if (!empty($movementCategory)) {
      return $this->transformInList($movementCategory);
    }
  }
}
