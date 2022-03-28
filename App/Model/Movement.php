<?php

namespace App\Model;

class Movement
{
  use Model;
  public function getById($id)
  {
    $db = $this->toConnection;
    $id = $db->escape($id);
    $db->where('id_movimentacao', $id);
    $movement = $db->get('movimentacao');
    if (!empty($movement)) {
      return $this->transformInItem($movement);
    }
  }

  public function getAllBetweenDate($startDate, $endDate)
  {
    $db = $this->toConnection;
    $startDate = $db->escape($startDate);
    $endDate = $db->escape($endDate);
    $db->where("date_movimentacao  BETWEEN '$startDate' AND '$endDate'");
    $movements = $db->get('movimentacao');
    if (!empty($movements)) {
      return $this->transformInList($movements);
    }
  }

  public function insert(array $movement)
  {
    $data = array(
      "nome_movimentacao" => $movement["Nome"],
      "valor_movimentacao" => $movement["Valor"],
      "date_movimentacao" => $movement["Data"],
      "fk_id_tipo_movimentacao" => $movement["typeMoviment"],
      "fk_id_categoria_movimentacao" => $movement["Categoria"],
    );
    if (!empty($movement["id_pai_movimentacao"])) {
      $data['id_pai_movimentacao'] = $movement["id_pai_movimentacao"];
    }
    $db = $this->toConnection;
    $id = $db->insert("movimentacao", $data);
  }
}
