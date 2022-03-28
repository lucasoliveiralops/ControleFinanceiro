<div class="modal fade" id="registerMovement" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="header-movement">
          <img src="view/assets/images/icon-money.png">
          <h4 class="modal-title">Cadastrar movimentação</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="formRegisterMovement" action="">
          <div class="form-group">
            <label for="Nome">Nome da movimentação:</label>
            <input type="text" class="form-control" name="Nome" id="Nome" placeholder="Exemplo: Sacolão Epa">
          </div>
          <div class="form-group">
            <label for="Valor">Valor da movimentação:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">R$</span>
              </div>
              <input type="number" min="1" step="any" name="Valor" id="Valor" class="form-control" placeholder="Exemplo: 25,00">
            </div>
          </div>
          <div class="form-group">
            <label for="Data">Data da movimentação:</label>
            <div class="input-group mb-3">
              <input type="date" name="Data" id="Data" class="form-control" value="<?= \App\Lib\Date::todayDateForInput() ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="clickMovementInstallments" name="checkboxMovementInstallments">
              <label class="form-check-label" for="clickMovementInstallments">Movimentação parcelada</label>
            </div>
          </div>
          <div class="form-group movementInstallments">
            <label for="Parcelas">Número de parcelas:</label>
            <input type="number" min="1" max="24" class="form-control" name="Parcelas" id="Parcelas">
            <small class="form-text text-muted">
              Você só irá preencher este campo caso a sua movimentação seja dividido em parcelas, o sistema irá pegar o total da movimentação e dividir pelo número de parcelas.
            </small>
          </div>
          <div class="form-group">
            <p class="label-block">Tipo do gasto:</p>
            <div class="radio-moviment">
              <input type="radio" id="loss" name="typeMoviment" value="2">
              <label for="loss"><img src="view/assets/images/icon-loss.png"></label>
            </div>
            <div class="radio-moviment">
              <input type="radio" id="profit" name="typeMoviment" value="1">
              <label for="profit"><img src="view/assets/images/icon-profit.png"></label>
            </div>
            <div class="form-group">
              <label for="Categoria" class="label-block">Categoria:</label>
              <select name="Categoria" id="Categoria" class="form-control js-categorys" style="width: 100%">
                <option>Selecione um tipo de gasto...</option>
                <?php foreach ($categories as $value) { ?>
                  <optgroup label="<?= $value['nameTypeCategory'] ?>">
                    <?php foreach ($value['categories'] as $categorie) { ?>
                      <option value="<?= $categorie->id ?>">
                        <?= $categorie->name ?></option>
                    <?php } ?>
                  </optgroup>
                <?php } ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>