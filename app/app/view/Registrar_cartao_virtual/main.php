<?php

use App\controller\ControllerMotorista;

# Objeto motorista
$motoristas = new ControllerMotorista();
$motoristas = $motoristas->listar($motoristas);

Use App\model\Conexao;

?>

<div class="container">
<div class="starter-template height-100">
  <h4 class="h4-registrar">Registrar Cartão Virtual</h4>
  
  <form action="<?=DIRPAGE.'/cartao-virtual/registrar'?>" method="POST">
  
    <div class="row">

      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <span>Motorista</span><br>
            <select class="form-control form-control-sm js-select" name="motorista">
            <?php
              foreach($motoristas as $motorista){
                $id_veiculo =  $motorista['id_motorista'];
                $nome_motorista =  $motorista['nome_motorista'];

              ?>
              <option value="<?= $id_veiculo ?>"> <?=$nome_motorista?> </option>
              <?php }?>
            </select>
          </div>  
        </div>

        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="form-group">
            <span>Validade do cartão</span>
            <input id="datetime" type="date" value="<?= date("d/m/Y");?>" name="data_validade" class="form-control form-control-sm">
            </div>
        </div>
    
        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="form-group">
            <span>Valor limite</span>
            <input type="text" name="valor_limite" class="form-control form-control-sm valor-limite">
            </div>
        </div>
        
        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="form-group">
            <span>Situação</span><br>
            
                <select class="form-control form-control-sm js-select" name="situacao">
                <?php
                $pdo = Conexao::getConn();
                $sql = "SELECT * FROM tbcartao_virtual_situacao";
                $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idSituacao =  $value['id_cartao_situacao'];
                        $situacao =  $value['cartao_situacao'];
                ?>
                <option value="<?= $idSituacao ?>"> <?php echo (ucwords($situacao))?> </option>
                <?php }?>
                </select>
            </div>
        </div>
           
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="form-group">
            <span>Renovação automática do limite</span>
            
                <select class="form-control form-control-sm js-select" name="renovacao_automatica">
                <?php
                $pdo = Conexao::getConn();
                $sql = "SELECT * FROM tbcartao_virtual_renovacao";
                $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idRenovacao =  $value['id_cartao_renovacao'];
                        $renovacao =  $value['cartao_renovacao'];
                ?>
                <option value="<?= $idRenovacao ?>"> <?php echo (ucwords($renovacao))?> </option>
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