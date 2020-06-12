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
  <h4>Registrar Abastecimento</h4>
  
  <form action="<?=DIRPAGE.'/abastecimento/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-2">
        <div class="form-group">
          <span>Fornecedor</span> 
            <select class="form-control form-control-sm" id="fornecedor"  name="fornecedor">
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
      
      <div class="col-2">
        <div class="form-group">
          <span>Quantidade</span> 
          <input  maxlength="20" type="number" name="quantidade" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Data</span>
          <input type="date" value="<?php echo date("Y-m-d");?>" name="data" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
            <span>Veículo</span> 
              <select class="form-control form-control-sm" name="veiculo">
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
          <span>Nº Comprovante</span>
          <input type="number" name="comprovante" class="form-control form-control-sm">
        </div>
      </div>

    </div>

    <div class="row">

    <div class="col-2">
        <div class="form-group">
          <span>Motorista</span> 
            <select class="form-control form-control-sm" id="motorista"  name="motorista">
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
      
      <div class="col-2">
        <div class="form-group">
          <span>Quilometragem</span>
          <input type="number" name="quilometragem" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Valor unitário / Litro</span>
          <input type="number" name="valorUnitario" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Combustível</span> 
            <select class="form-control form-control-sm" id="combustivel"  name="combustivel">
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