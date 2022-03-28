<main class="main-home">
  <div class='dashboard'>
    <?php include 'View/home/dashboard.php' ?>
  </div>
  <div class='container'>
    <div class='actions'>
      <button class="btn btn-success" data-toggle="modal" data-target="#registerMovement">
        Cadastrar movimentação
      </button>
    </div>
    <div class='data'>
      <?php include 'View/home/listMovements.php' ?>
    </div>
</main>
<?php include 'View/home/registerMovementModal.php' ?>