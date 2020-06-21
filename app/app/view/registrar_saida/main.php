<?php

use App\controller\ControllerMotorista;
use App\controller\ControllerTanque;
use App\controller\ControllerVeiculo;

  // Objeto Fornecedor
  $motoristas = new ControllerMotorista();
  $motoristas = $motoristas->listar($motoristas);

  // Objeto Tanque de Combustivel
  $tanques = new ControllerTanque();
  $tanques = $tanques->listar($tanques);

   // Objeto Tanque de Combustivel
   $veiculos = new ControllerVeiculo();
   $veiculos = $veiculos->listar($veiculos);
?>

<div class="container">
<div class="starter-template height-100">
  <h4>Registrar saída de combustível</h4>
  
  <form action="<?=DIRPAGE.'/movimento_saida/registrar'?>" method="POST">
    <div class="row">
    
      <div class="col-3">
        <div class="form-group">
          <span>Motorista</span> 
            <select class="form-control form-control-sm js-select" id="motorista"  name="motorista" required>
            <?php
              foreach($motoristas as $motorista){
                $idMotorista =  $motorista['id_motorista'];
                $nomeMotorista =  $motorista['nome_motorista'];
              ?>
              <option value="<?= $idMotorista ?>"> <?php echo ucwords($nomeMotorista)?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
      
      <div class="col-2">
        <div class="form-group">
          <span>Quantidade</span> 
          <input type="text" name="quantidade" class="form-control form-control-sm quantidade" required>
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <span>Tanque</span> 
            <select class="form-control form-control-sm js-select" name="tanque" required>
            <?php
              foreach($tanques as $tanque){
                $idTanque =  $tanque['id_tanque'];
                $nomeTanque =  $tanque['nome_tanque'] . " - " . $tanque['categoria_combustivel'];

              ?>
              <option value="<?= $idTanque ?>"> <?php echo $nomeTanque?> </option>
              <?php }?>
            </select>
          </div>  
        </div>

      <div class="col-3">
        <div class="form-group">
          <span>Data/Hora saída</span>
          <input type="text" date-input="d/m/y h:i" name="data" class="form-control form-control-sm" required>
        </div>
      </div>

    </div>

    <div class="row">
      
      <div class="col-3">
        <div class="form-group">
            <span>Veículo</span> 
              <select class="form-control form-control-sm js-select" name="veiculo" required>
              <?php
                foreach($veiculos as $veiculo){
                  $idVeiculo =  $veiculo['id_veiculo'];
                  $nomeVeiculo =  $veiculo['nome_modelo'] . " - " . $veiculo['placa'];
              ?>
              <option value="<?= $idVeiculo ?>"> <?php echo $nomeVeiculo?> </option>
              <?php }?>
            </select>
          </div>  
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Quilometragem</span>
          <input type="text" name="quilometragem" class="form-control form-control-sm"  maxlength="10" required>
        </div>
      </div>

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>