<?php

use App\controller\ControllerVeiculo;
use App\controller\ControllerFornecedor;
use App\controller\ControllerCatCombustivel;
use App\model\Conexao;

// Objeto Fornecedor
$fornecedores = new ControllerFornecedor();
$fornecedores = $fornecedores->listar($fornecedores);

// Objeto Tanque de Combustivel
$veiculos = new ControllerVeiculo();
$veiculos = $veiculos->listar($veiculos);

// Objeto Tanque de Combustivel
$categoria_combustiveis = new ControllerCatCombustivel();
$categoria_combustiveis = $categoria_combustiveis->listar($categoria_combustiveis);
?>

<div class="container">
<div class="starter-template height-100">
  <h4>Registrar Movimento Cartão Virtual</h4>
  
  <form action="<?=DIRPAGE.'/movimento_entrada/registrar'?>" method="POST">
    <div class="row">
    
      <div class="col-3">
        <div class="form-group">
          <span>Fornecedor</span> 
            <select class="form-control form-control-sm" id="fornecedor"  name="fornecedor">
            <?php
              foreach($fornecedores as $fornecedor){
                $idFornecedor =  $fornecedor['id_fornecedor'];
                $nomeFornecedor =  $fornecedor['razao_social'];
              ?>
              <option value="<?= $idFornecedor ?>"> <?php echo ($nomeFornecedor)?> </option>
              <?php }?>
            </select>
          </div>  
        </div>

        <div class="col-3">
            <div class="form-group">
                <span>Veículo</span> 
                <select class="form-control form-control-sm" name="veiculo">
                <?php
                foreach($veiculos as $veiculo){
                    $idVeiculo =  $veiculo['id_veiculo'];
                    $veiculo =  $veiculo['placa'];
                ?>
                <option value="<?=$idVeiculo?>"> <?=$veiculo?> </option>
                <?php }?>
                </select>
            </div>  
        </div>

        <div class="col-3">
            <div class="form-group">
                <span>Categoria Combustível</span> 
                <select class="form-control form-control-sm" name="categoria_combustivel">
                <?php
                foreach($categoria_combustiveis as $categoria_combustivel){
                    $idCatCombustivel = $categoria_combustivel['id_combustivel'];
                    $catCombustivel = $categoria_combustivel['categoria_combustivel'];
                ?>
                <option value="<?=$idCatCombustivel?>"> <?=$catCombustivel?> </option>
                <?php }?>
                </select>
            </div>  
        </div>
      
      <div class="col-2">
        <div class="form-group">
          <span>Quantidade</span> 
          <input  maxlength="20" min="1" type="number" name="quantidade" class="form-control form-control-sm">
        </div>
      </div>



      <div class="col-3">
        <div class="form-group">
          <span>Data abastecimento</span>
          <input id="datetime" type="datetime" value="<?php echo date("d/m/Y h:i");?>" name="data" class="form-control form-control-sm">
        </div>
      </div>
    </div>

    <div class="row">

        <div class="col-2">
            <div class="form-group">
                <span>Valor unitário:</span>
                <input  maxlength="10" type="int" name="valor_unitario" class="form-control form-control-sm">
            </div>
        </div>
                
        <div class="col-2">     
            <div class="form-group">      
            <span>Situação</span>    
            <select class="form-control form-control-sm" name="movimento_situacao">
                <?php
                    
                $pdo = Conexao::getConn();
                $sql = "SELECT * FROM tbcartao_virtual_movimentos_situacao";
                $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idMovimento_situacao =  $value['id_cartao_movimento_situacao'];
                        $movimento_situacao =  $value['movimento_situacao'];
                ?>
                <option value="<?= $idMovimento_situacao ?>"> <?=$movimento_situacao?> </option>
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