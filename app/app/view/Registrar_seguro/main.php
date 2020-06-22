<?php
use App\controller\ControllerFornecedor;
use App\controller\ControllerVeiculo;

$fornecedores = new ControllerFornecedor();
$fornecedores = $fornecedores->listarSeguradoras($fornecedores);

Use App\model\Conexao;
# Objeto veiculo
$veiculos = new ControllerVeiculo();
$veiculos = $veiculos->listar($veiculos);
?>

<div class="container">
<div class="starter-template height-100">
  <h4 class="h4-registrar">Registrar Seguro</h4>
  
  <form action="<?=DIRPAGE.'/seguro/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-3">
        <div class="form-group">
          <span>Seguradora</span> 
            <select class="form-control form-control-sm js-select" name="fornecedor">
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
      
      <div class="col-4">
        <div class="form-group">
          <span>Apólice</span> 
          <input maxlength="40" type="text" name="apolice" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <label for="data">Data vencimento *</label>
          <input id="data" type="text" date-input="d/m/y" name="data_vencimento" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <label for="veiculo">Veículo</label> 
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
      
      <div class="col-3">
        <div class="form-group">
          <span>Situação</span>
        
            <select class="form-control form-control-sm js-select" name="situacao">
            <?php
            $pdo = Conexao::getConn();
            $sql = "SELECT * FROM tbpagamento_situacao";
            $resultado = $pdo->query($sql);

                foreach($resultado as $value){
                    $idSituacao =  $value['id_situacao'];
                    $situacao =  $value['situacao'];
            ?>
            <option value="<?= $idSituacao ?>"> <?php echo (ucwords($situacao))?> </option>
            <?php }?>
            </select>
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Valor</span>
          <input type="text" name="valor" class="form-control form-control-sm valor-limite">
        </div>
      </div>  

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>