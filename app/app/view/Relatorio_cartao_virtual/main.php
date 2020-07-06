<?php
  use App\controller\ControllerMotorista;

  // Objeto Motoristas
  $motoristas = new ControllerMotorista;
  $motoristas = $motoristas->listar($motoristas);

  Use App\model\Conexao;
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório Cartão Virtual</h4>
  
<form action="<?=DIRPAGE.'/relatorio-cartao-virtual/render'?>" method="POST">
    <div class="row">


        <div class="col-2">
            <div class="form-group">
                <span>Motoristas *</span> 
                <select class="form-control form-control-sm" name="motorista[]" multiple required>
                <?php
                foreach($motoristas as $value){
                $idMotorista =  $value['id_motorista'];
                $nomeMotorista = $value['nome_motorista'];
                ?>
                <option value="<?= $idMotorista ?>"> <?php echo $nomeMotorista?> </option>
                <?php }?>
                </select>
            </div>  
        </div>


      <div class="col-sm-12 col-md-2 col-lg-3 ml-5">
        <div class="form-group">
          <span>Situação do Cartão *</span><br>
          <select class="form-control form-control-sm" name="situacao[]" multiple required>
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

    </div>
    <div class="row">

      <div class="col-2">
        <div class="form-group">
          <span>Validade Inicial *</span> 
          <input type="date" name="data_inicial" date-input="d/m/y" class="form-control form-control-sm" required>
        </div>  
      </div>
    
      <div class="col-2">
        <div class="form-group">
          <span>Validade Final *</span> 
          <input type="date" name="data_final" date-input="d/m/y" class="form-control form-control-sm" required>
        </div>
      </div>
      
    </div>

    <input class="btn btn-success" type="submit" value="Processar">
</form>
</div>


<script>
  $('select[multiple]').multiselect()
</script>