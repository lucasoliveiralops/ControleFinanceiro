<table class="table table-hover listMovements">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome movimentação</th>
      <th scope="col">Valor Movimentação</th>
      <th scope="col">Data da movimentação</th>
      <th scope="col">Categoria</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($movements as $movement) { ?>
      <tr>
        <th scope="row"><?= $movement->id ?></th>
        <td><?= $movement->name ?></td>
        <td><?= $movement->value ?></td>
        <td><?= \App\Lib\Date::formatDate($movement->date) ?></td>
        <td><?= $movement->getCategoryMovement ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>