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
  <h4>Registrar Manutenção Veículo</h4>
  
  <form action="<?=DIRPAGE.'/manutencao/registrar/'?>" method="POST">
    <div class="row">
    
      <div class="col-sm-12 col-md-3">
        <div class="form-group">
          <span>Fornecedor</span> 
            <select class="form-control form-control-sm  js-select" name="fornecedor">
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
      
      <div class="col-sm-12 col-md-4">
        <div class="form-group">
          <span>Título</span> 
          <input  maxlength="50" type="text" name="titulo" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <span>Data vencimento</span>
          <input type="date" value="<?php echo date("Y-m-d");?>" name="data_vencimento" class="form-control form-control-sm">
        </div>
      </div>
    </div>

    <div class="row">

    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <span>Veículo</span> 
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
      
      <div class="col-sm-12 col-md-2">
        <div class="form-group">
          <span>Valor</span>
          <input type="number" name="valor" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-sm-12 col-md-3">
        <div class="form-group">
          <span>Situação</span>
        
            <select class="form-control form-control-sm js-select" name="situacao_pagamento">
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

      <div class="col-sm-12 col-md-3">
        <div class="form-group">
          <span>Tipo de manutenção</span>
        
            <select class="form-control form-control-sm js-select" name="tipo_manutencao">
            <?php
            $pdo = Conexao::getConn();
            $sql = "SELECT * FROM tbmanutencao_tipo";
            $resultado = $pdo->query($sql);

              foreach($resultado as $value){
                $idManutencaoTipo =  $value['id_manutencao_tipo'];
                $tipoManutencao =  $value['tipo_manutencao'];
            ?>
            <option value="<?=$idManutencaoTipo?>"> <?=ucwords($tipoManutencao)?> </option>
            <?php }?>
            </select>
        </div>
      </div>

      <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea  name="descricao" class="form-control" id="descricao" rows="4" maxlength="200" style="resize: none"></textarea>
        </div>
      </div>

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>