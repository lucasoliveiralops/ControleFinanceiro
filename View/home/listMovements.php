<table class="table table-hover listMovements">
  <thead>
    <tr>
      <th scope="col">Tipo</th>
      <th scope="col">Nome movimentação</th>
      <th scope="col">Valor Movimentação</th>
      <th scope="col">Categoria</th>
      <th scope="col">Data da movimentação</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (is_array($data)) {
      foreach ($data as $movement) { ?>
        <tr>
          <th scope="row"><?= $movement->getTypeMovement ?></th>
          <td><?= $movement->name ?></td>
          <td><?= 'R$' . number_format($movement->value, 2, ',', '.');  ?></td>
          <td><?= $movement->getCategoryMovement ?></td>
          <td><?= \App\Lib\Date::formatDateBR($movement->date) ?></td>
          <td><?= $movement->getNameStatusMovement ?></td>
        </tr>
    <?php
      }
    } else {
      echo "<td  colspan='100'>Nenhuma transação cadastra neste mês</td>";
    } ?>
  </tbody>
</table>