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
  <h4 class="h4-registrar">Registrar Abastecimento em Trânsito</h4>
  
  <form action="<?=DIRPAGE.'/movimento-transito/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-sm-12 col-md-3">
        <div class="form-group">
          <label for="fornecedor">Fornecedor *</label>
            <select id="fornecedor" class="form-control form-control-sm js-select" id="fornecedor" name="fornecedor">
              <?php
              foreach($fornecedores as $fornecedor){
                $idFornecedor =  $fornecedor['id_fornecedor'];
                $nomeFornecedor =  ucwords($fornecedor['razao_social']);
              ?>
              <option value="<?= $idFornecedor ?>"> <?php echo ($nomeFornecedor)?> </option>
              <?php }?>
            </select>
            <a href="#">Registrar</a>
          </div>  
        </div>


        <div class="col-sm-12 col-md-3">
         <div class="form-group">
          <label for="motorista" title="Nome do motorista">Condutor *</label>
            <select id="motorista" class="form-control form-control-sm js-select" id="motorista" name="motorista">
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
            <label for="veiculo">Veículo *</label>
              <select id="veiculo" class="form-control form-control-sm js-select" name="veiculo">
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

        <div class="col-sm-12 col-md-2">
          <div class="form-group">
            <label for="quantidade">Quantidade *</label>
            <input id="quantidade"  maxlength="20" type="text" name="quantidade" class="form-control form-control-sm quantidade" required>
          </div>
        </div>
        

        <div class="col-sm-12 col-md-2">
          <div class="form-group">
            <label for="data">Data *</label>
            <input id="data" date-input="d/m/y h:i:s" type="text" name="data" class="form-control form-control-sm">
          </div>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="form-group">
            <label for="comprovante">Nº Comprovante *</label>
            <input id="comprovante" type="text" name="comprovante" class="form-control form-control-sm" required>
            </div>
        </div>
      

      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <label for="quilometragem" title="Digite aqui KM atual informado no hodômetro do veículo.">KM Atual *</label>
          <input id="quilometragem" type="text" name="quilometragem" class="form-control form-control-sm quantidade" required>
        </div>
      </div>

      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <label for="valor_unitario">Valor Un./ (L) *</label>
          <input id="valor_unitario" name="valor_unitario" class="form-control form-control-sm valor-unitario" required>
        </div>
      </div>

    </div>

    <div class="row">

        <div class="col-sm-12 col-md-3">
            <div class="form-group">
                <span>Combustível *</span><br>
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