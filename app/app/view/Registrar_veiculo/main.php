<?php

use App\model\Conexao;
?>

<div class="container">
<div class="starter-template height-100">
  <h4>Registrar Veículo</h4>
  
    <form action="<?=DIRPAGE.'/veiculo/registrar/'?>" method="POST">
    
    <div class="row">

      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <label for="placa">Veículo *</label>
          <input maxlength="8" placeholder="Placa" type="text" name="placa" class="form-control form-control-sm" id="placa" required>
        </div>
      </div>

      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
            <label for="tipo_veiculo">Tipo de Veículo *</label>
            <select class="form-control form-control-sm js-select" id="tipo_veiculo" name="tipo_veiculo">
              <?php
              #SQL DIRETO
              $pdo = Conexao::getConn();
              $sql = "SELECT * FROM tbveiculo_tipo" ;
        
              $resultado = $pdo->query($sql);

              foreach($resultado as $value){
                  $idTipoVeiculo =  $value['id_tipo_veiculo'];
                  $tipoVeiculo =  $value['tipo_veiculo'];
              ?>
              <option value="<?= $idTipoVeiculo ?>"><?=$tipoVeiculo?></option>
              <?php }?>
            </select>
          </div>  
      </div>

      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
            <label for="modelo_fabricante">Modelo/Fabricante *</label>
            <select class="form-control form-control-sm js-select" id="modelo_fabricante" name="id_modelo" required>
              <?php
              #SQL DIRETO
              $pdo = Conexao::getConn();
              $sql = "SELECT a.*, b.* FROM tbmodelo_veiculo a
              INNER JOIN tbfabricante_veiculo b ON (a.id_fabricante = b.id_fabricante)";
        
              $resultado = $pdo->query($sql);

              foreach($resultado as $value){
                  $idModelo =  $value['id_modelo'];
                  $nomeModelo =  $value['modelo_veiculo'];
                  $nomeFabricante =  $value['nome_fabricante'];
              ?>
              <option value="<?= $idModelo ?>"><?=$nomeModelo . " / " . $nomeFabricante ?></option>
              <?php }?>
            </select>
            </div>  
        </div>

      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span>Ano Fabricação *</span>
          <input type="date" value="<?php echo date("d/m/Y");?>" name="ano_fabricacao" date-input="d/m/y" class="form-control form-control-sm" required>
        </div>
      </div>           

    </div>

    <div class="row">
      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span>Ano Modelo *</span>
          <input type="text" placeholder="Ex: 20/20" name="ano_modelo" class="form-control form-control-sm" required>
        </div>
      </div>

      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <span title="Apenas números">Renavam</span>
          <input maxlength="25" type="text" name="renavam" class="form-control form-control-sm">
        </div>
      </div>     

       <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span title="Capacidade tanque de combustível do veículo">Tanque(LT) *</span>
          <input maxlength="25" type="text" name="quantidade_tanque" class="form-control form-control-sm" required>
        </div>
      </div>  

      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span>Cor</span>
            <input maxlength="20" placeholder="Cor" type="text" name="cor" class="form-control form-control-sm">
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <span title="Apenas números">Chassi</span>
          <input maxlength="25" placeholder="Chassi" type="text" name="chassi" class="form-control form-control-sm">
        </div>
      </div>

      <div class="col-sm-12 col-md-3 col-lg-3">
        <label for="tipoCombustivel">Tipo de Combustível</label>
        <select class="form-control js-select" id="tipoCombustivel" name="tipoCombustivel">
          <?php
          #SQL DIRETO
          $pdo = Conexao::getConn();
          $sql = "SELECT id_combustivel, categoria_combustivel FROM tbcategoria_combustivel";
          $resultado = $pdo->query($sql);

          foreach($resultado as $value){
              $idCombustivel =  $value['id_combustivel'];
              $nomeCombustivel =  $value['categoria_combustivel'];
          ?>
          <option value="<?= $idCombustivel ?>"><?php echo $nomeCombustivel?></option>
          <?php }?>
        </select>
      </div>  


        <div class="col-sm-12 col-md-3 col-lg-3">
            <label for="categoriaVeiculo">Categoria do Veículo</label>
            <select class="form-control js-select" id="categoriaVeiculo"  name="categoriaVeiculo">
              <?php
              #SQL DIRETO
              $pdo = Conexao::getConn();
              $sql = "SELECT id_categoria_veiculo, categoria_veiculo FROM tbcategoria_veiculo";
              $resultado = $pdo->query($sql);

              foreach($resultado as $value){
                  $idCatVeiculo =  $value['id_categoria_veiculo'];
                  $nomeCategoria =  $value['categoria_veiculo'];
              ?>
              <option value="<?= $idCatVeiculo ?>"><?=$nomeCategoria?></option>
              <?php }?>
            </select>
        </div>
    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>
</div>