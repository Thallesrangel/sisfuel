<?php

use App\controller\ControllerVeiculo;

// Objeto Fornecedor
$veiculos = new ControllerVeiculo();
$veiculos = $veiculos->listar($veiculos);

Use App\model\Conexao;

?>

<div class="container">
<div class="starter-template height-100">
  <h4 class="h4-registrar">Registrar IPVA</h4>
  
  <form id="form" action="<?=DIRPAGE.'/ipva/registrar'?>" method="POST">
  
    <div class="row">

      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <span>Veículos</span><br>
            <select class="form-control form-control-sm js-select" name="veiculo">
            <?php
              foreach($veiculos as $veiculo){
                $idVeiculo =  $veiculo['id_veiculo'];
                $veiculo =  $veiculo['placa'];

              ?>
              <option value="<?= $idVeiculo ?>"> <?php echo $veiculo?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
            


      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span>Data Vencimento</span>
          <input type="date" value="<?= date("d/m/Y");?>" name="data_vencimento" date-input="d/m/y" class="form-control form-control-sm">
        </div>
      </div>


        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="form-group">
            <span>Valor</span>
            <input  maxlength="10" type="int" name="valor" class="form-control form-control-sm valor-limite">
            </div>
        </div>
        
      <div class="col-sm-12 col-md-2 col-lg-3">
        <div class="form-group">
          <span>Situação</span><br>
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
    
</div>

    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>