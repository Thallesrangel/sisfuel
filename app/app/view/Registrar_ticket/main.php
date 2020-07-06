<?php

use App\controller\ControllerFornecedor;
use App\controller\ControllerTanque;
use App\controller\ControllerCatCombustivel;
use App\controller\ControllerVeiculo;
use App\controller\ControllerMotorista;

  // Objeto Fornecedor
  $fornecedores = new ControllerFornecedor();
  $fornecedores = $fornecedores->listar($fornecedores);

  // Objeto Tanque de Combustivel
  $tanques = new ControllerTanque();
  $tanques = $tanques->listar($tanques);

  // Objeto Tanque de Combustivel
  $combustivel = new ControllerCatCombustivel();
  $combustivel = $combustivel->listar($combustivel);
  
  // Objeto Veículos
  $veiculos = new ControllerVeiculo();
  $veiculos = $veiculos->listar($veiculos);

  // Objeto Motorista
  $motoristas = new ControllerMotorista();
  $motoristas = $motoristas->listar($motoristas);

  require_once(DIRREQ.'/app/view/layout/mensagens.php');
  unset($_SESSION["mensagem"]);
?>

<div class="container">
<div class="starter-template height-100">
  <h4 class="h4-registrar">Registrar Ticket</h4>
  
  <form action="<?=DIRPAGE.'/ticket/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-3">
        <div class="form-group">
          <span>Fornecedor</span> 
            <select class="form-control form-control-sm js-select" id="fornecedor"  name="fornecedor">
            <?php

              foreach ($fornecedores as $fornecedor) {
                $idFornecedor =  $fornecedor['id_fornecedor'];
                $nomeFornecedor =  ucwords($fornecedor['razao_social']);
                
              ?>

              <option value="<?=$idFornecedor?>"> <?=$nomeFornecedor?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
      
      <div class="col-2">
        <div class="form-group">
          <span>Quantidade (L)</span> 
          <input  maxlength="20" type="text" name="quantidade" class="form-control form-control-sm quantidade" required>
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <span>Combustível</span> 
            <select class="form-control form-control-sm js-select" name="combustivel">
            <?php

              foreach ($combustivel as $combustiveis) {
                $idCombustivel =  $combustiveis['id_combustivel'];
                $combustivel =  $combustiveis['categoria_combustivel'];

              ?>

              <option value="<?= $idCombustivel ?>"> <?php echo $combustivel?> </option>
              <?php }?>
            </select>
          </div>  
        </div>

      <div class="col-2">
        <div class="form-group">
          <label for="data">Data</label>
          <input id="data" date-input="d/m/y h:i:s" type="text" name="data" class="form-control form-control-sm">
        </div>
      </div>

    </div>

    <div class="row">


    <div class="col-3">
        <div class="form-group">
            <span>Motorista</span> 
            <select class="form-control form-control-sm js-select" name="motorista">
            <?php

              foreach ($motoristas as $motorista) {
                $idMotorista =  $motorista['id_motorista'];
                $motorista =  ucwords($motorista['nome_motorista']);
              ?>

              <option value="<?= $idMotorista ?>"> <?php echo $motorista?> </option>
              <?php }?>
            </select>
        </div>  
      </div>

      
      <div class="col-3">
        <div class="form-group">
            <span>Veículo</span> 
            <select class="form-control form-control-sm js-select" name="veiculo">
            <?php

              foreach ($veiculos as $placas) {
                $idPlaca =  $placas['id_veiculo'];
                $placa =  $placas['placa'];
              ?>

              <option value="<?= $idPlaca ?>"> <?=$placa?> </option>
              <?php }?>
            </select>
        </div>  
      </div>

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>