<?php

use App\controller\ControllerTanque;
use App\controller\ControllerFornecedor;

// Objeto Fornecedor
$fornecedores = new ControllerFornecedor();
$fornecedores = $fornecedores->listar($fornecedores);

// Objeto Tanque de Combustivel
$tanques = new ControllerTanque();
$tanques = $tanques->listar($tanques);
?>

<div class="container">
<div class="starter-template height-100">
  <h4>Registrar entrada de combustível</h4>
  
  <form action="<?=DIRPAGE.'/movimento_entrada/registrar'?>" method="POST">
    <div class="row">
    
      <div class="col-3">
        <div class="form-group">
          <span>Fornecedor</span> 
            <select class="form-control form-control-sm js-select" id="fornecedor"  name="fornecedor" required>
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
      
      <div class="col-2">
        <div class="form-group">
          <span>Quantidade</span> 
          <input  maxlength="20" min="1" type="text" name="quantidade" class="form-control form-control-sm quantidade" required>
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <span>Tanque</span> 
            <select class="form-control form-control-sm js-select" name="tanque" required>
            <?php
              foreach($tanques as $tanque){
                $idTanque =  $tanque['id_tanque'];
                $nomeTanque =  $tanque['nome_tanque'];

              ?>
              <option value="<?= $idTanque ?>"> <?php echo $nomeTanque?> </option>
              <?php }?>
            </select>
          </div>  
        </div>

      <div class="col-3">
        <div class="form-group">
          <span>Data</span>
          <input id="datetime" type="datetime" value="<?php echo date("d/m/Y h:i");?>" name="data" class="form-control form-control-sm" required>
        </div>
      </div>
    </div>

    <div class="row">

     <div class="col-2">
        <div class="form-group">
          <span>Nº Nota Fiscal</span>
          <input type="number" name="nf" class="form-control form-control-sm" required>
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <span>Motorista</span>
          <input maxlength="35" type="text" name="motorista" autocomplete="off" class="form-control form-control-sm" required>
        </div>
      </div>

      
      <div class="col-2">
        <div class="form-group">
          <span>Placa:</span>
          <input  maxlength="10" type="int" name="placa" class="form-control form-control-sm" required>
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
          <span>Valor unitário:</span>
          <input maxlength="5" max="5" min="0" type="text" name="valor_unitario" class="form-control form-control-sm valor-unitario" required>
        </div>
      </div>

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>