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
  <h4 class="h4-registrar">Registrar Abastecimento</h4>
  
  <form action="<?=DIRPAGE.'/abastecimento/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-3">
        <div class="form-group">
          <span>Fornecedor *</span> 
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

      <div class="col-3">
        <div class="form-group">
            <span>Veículo *</span> 
              <select class="form-control form-control-sm js-select" name="veiculo">
              <?php
                foreach($veiculos as $veiculo){
                  $idVeiculo =  $veiculo['id_veiculo'];
                  $nomeVeiculo =  $veiculo['placa'];
              ?>
              <option value="<?= $idVeiculo ?>"> <?php echo $nomeVeiculo?> </option>
              <?php }?>
            </select>
        </div>  
      </div>
      
      <div class="col-2">
        <div class="form-group">
          <span>Quantidade *</span> 
          <input maxlength="20" min="1" type="text" name="quantidade" class="form-control form-control-sm quantidade">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Data *</span>
          <input type="text"  date-input="d/m/y h:i:s" name="data" class="form-control form-control-sm">
        </div>
      </div>


    </div>

    <div class="row">

      <div class="col-2">
        <div class="form-group">
          <span>Nº Comprovante *</span>
          <input type="text" name="comprovante" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <span>Motorista *</span> 
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
      
      <div class="col-2">
        <div class="form-group">
          <span>Quilometragem *</span>
          <input type="number" name="quilometragem" class="form-control form-control-sm">
        </div>
      </div>    
    </div>


    <div class="row">

      <div class="col-2">
        <div class="form-group">
          <span>Valor unitária *</span>
          <input type="text" name="valorUnitario" class="form-control form-control-sm valor-unitario">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
        <span>Combustível *</span> 
          <select class="form-control form-control-sm js-select" id="combustivel"  name="combustivel">
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