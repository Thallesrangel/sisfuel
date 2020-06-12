<?php

session_start();

if ($_SESSION["usuario"] == "" || $_SESSION["usuario"] == NULL) {
  header("Location: ../index.php");
}
  require_once "./layout/head.php";
  require_once "./layout/sidebar.php";
  require_once "./layout/navbar.php";

  require_once "../controller/ControllerMotorista.php";
  require_once "../controller/ControllerFornecedor.php";
  require_once "../controller/ControllerVeiculo.php";

  // Objeto Fornecedor
  $fornecedores = new ControllerFornecedor();
  $fornecedores = $fornecedores->listar($fornecedores);

  // Objeto Motorista
  $motoristas = new ControllerMotorista();
  $motoristas = $motoristas->listar($motoristas);

   // Objeto veículo
   $veiculos = new ControllerVeiculo();
   $veiculos = $veiculos->listar($veiculos);
?>

<div class="container">
  <h4>Registrar abastecimento em trânsito</h4>
  
  <form action="../process/acad_abastecimento_transito.php" method="POST">
    <div class="row">

      <div class="col-2">
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
      
      <div class="col-2">
        <div class="form-group">
          <span>Motorista</span> 
            <select class="form-control form-control-sm" id="motorista"  name="motorista">
            <?php
              foreach($motoristas as $motorista){
                $idMotorista =  $motorista['id_motorista'];
                $nomeMotorista =  $motorista['nome_motorista'];
              ?>
              <option value="<?= $idMotorista ?>"> <?php echo ($nomeMotorista)?> </option>
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

      <div class="col-3">
        <div class="form-group">
          <span>Data/Hora abastecimento</span>
          <input type="date" value="<?php echo date("Y-m-d");?>" name="data" class="form-control form-control-sm">
        </div>
      </div>

    </div>

    <div class="row">
      
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
          <span>Quilometragem</span>
          <input type="number" name="quilometragem" class="form-control form-control-sm">
        </div>
      </div>

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>

<script>

</script>

<?php
    require_once "./layout/footer.php";
?>

