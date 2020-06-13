<?php
use App\controller\ControllerFornecedor;
use App\controller\ControllerVeiculo;
use App\controller\ControllerMotorista;
use App\controller\ControllerCatCombustivel;
use App\controller\ControllerTanque;

$fornecedores = new ControllerFornecedor();
$fornecedores = $fornecedores->listar($fornecedores);

// Objeto Tanque de Combustivel
$tanques = new ControllerTanque();
$tanques = $tanques->listar($tanques);

# Objeto motorista
$motoristas = new ControllerMotorista();
$motoristas = $motoristas->listar($motoristas);

# Objeto veiculo
$veiculos = new ControllerVeiculo();
$veiculos = $veiculos->listar($veiculos);

# Objeto categoria combustivel
$combsutivel = new ControllerCatCombustivel();
$combsutivelResultado = $combsutivel->listar($combsutivel);
?>

<div class="container">
<div class="starter-template height-100">
  <h4>Registrar Movimento em Trânsito</h4>
  
  <form action="<?=DIRPAGE.'/abastecimento/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-sm-12 col-md-3">
        <div class="form-group">
          <span>Fornecedor</span><br>
            <select class="form-control form-control-sm js-select" id="fornecedor"  name="fornecedor">
              <?php
              foreach($fornecedores as $fornecedor){
                $idFornecedor =  $fornecedor['id_fornecedor'];
                $nomeFornecedor =  ucwords($fornecedor['razao_social']);
              ?>
              <option value="<?= $idFornecedor ?>"> <?php echo ($nomeFornecedor)?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
      
      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <span>Quantidade</span><br>
          <input  maxlength="20" type="text" name="quantidade" class="form-control form-control-sm quantidade">
        </div>
      </div>

      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <span>Data</span><br>
          <input type="date" value="<?php echo date("Y-m-d");?>" name="data" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <span>Veículo</span><br>
              <select class="form-control form-control-sm js-select" name="veiculo">
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

    </div>

    <div class="row">

        <div class="col-sm-12 col-md-3">
            <div class="form-group">
            <span>Nº Comprovante</span><br>
            <input type="number" name="comprovante" class="form-control form-control-sm">
            </div>
        </div>
      

        <div class="col-sm-12 col-md-3">
         <div class="form-group">
          <span>Motorista</span><br>
            <select class="form-control form-control-sm js-select" id="motorista"  name="motorista">
            <?php
              foreach($motoristas as $motorista){
                $idMotorista =  $motorista['id_motorista'];
                $nomeMotorista =  ucwords($motorista['nome_motorista']);
              ?>
              <option value="<?= $idMotorista ?>"> <?php echo ($nomeMotorista)?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
      
      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <span>Quilometragem</span><br>
          <input type="text" name="quilometragem" class="form-control form-control-sm quantidade">
        </div>
      </div>

      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <span>Valor Un. /L</span><br>
          <input type="text" name="valorUnitario" class="form-control form-control-sm valor-unitario">
        </div>
      </div>

    </div>

    <div class="row">

        <div class="col-sm-12 col-md-3">
            <div class="form-group">
                <span>Combustível</span><br>
                <select class="form-control form-control-sm js-select"  name="combustivel">
                <?php
                foreach($combsutivelResultado as $combustivel){
                    $idCombustivel =  $combustivel['id_combustivel'];
                    $nomeCombustivel =  $combustivel['categoria_combustivel'];
                ?>
                <option value="<?= $idCombustivel ?>"> <?php echo ($nomeCombustivel)?> </option>
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