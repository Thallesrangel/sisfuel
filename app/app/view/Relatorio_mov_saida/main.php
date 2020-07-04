<?php
  use App\controller\ControllerVeiculo;
  use App\controller\ControllerTanque;
  use App\controller\ControllerMotorista;

  // Objeto Veículos
  $veiculos = new ControllerVeiculo();
  $veiculos = $veiculos->listar($veiculos);

  // Objeto Tanque
  $tanques = new ControllerTanque;
  $tanques = $tanques->listar($tanques);

  // Objeto Motorista
  $motoristas = new ControllerMotorista();
  $motoristas = $motoristas->listar($motoristas);
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório Movimento de Saída</h4>
  
<form action="<?=DIRPAGE.'/relatorio_movimento_saida/render'?>" method="POST">
    <div class="row">

      <div class="col-2">
        <div class="form-group">
            <span>Veículos *</span> 
            <select id='selectVeiculo' class="form-control form-control-sm" name="veiculo[]" multiple required>
            <?php
              foreach($veiculos as $veiculo){
              $idVeiculo =  $veiculo['id_veiculo'];
              $nomeVeiculo = $veiculo['placa'];
            ?>
            <option value="<?= $idVeiculo ?>"> <?php echo $nomeVeiculo?> </option>
            <?php }?>
            </select>
        </div>  
      </div>

      <div class="col-2 ml-5">
        <div class="form-group">
            <span>Tanques *</span> 
            <select id='selectTanque' class="form-control form-control-sm" name="tanque[]" multiple required>
            <?php
                foreach($tanques as $value){
                $idTanque =  $value['id_tanque'];
                $nomeTanque =  $value['nome_tanque'];
            ?>
            <option value="<?= $idTanque ?>"> <?=$nomeTanque?> </option>
            <?php }?>
            </select>
        </div>  
      </div>


      <div class="col-2 ml-5">
        <div class="form-group">
            <span>Motoristas *</span> 
            <select id='selectMotorista' class="form-control form-control-sm" name="motorista[]" multiple required>
            <?php
                foreach($motoristas as $value){
                $idMotorista =  $value['id_motorista'];
                $nomeMotorista =  $value['nome_motorista'];
            ?>
            <option value="<?= $idMotorista ?>"> <?=$nomeMotorista?> </option>
            <?php }?>
            </select>
        </div>  
      </div>
            
    </div>
    <div class="row">

      <div class="col-2">
        <div class="form-group">
          <span>Data Inicial *</span> 
          <input type="date" name="data_inicial" date-input="d/m/y h:i:s" class="form-control form-control-sm" required>
        </div>  
      </div>
    
      <div class="col-2">
        <div class="form-group">
          <span>Data Final *</span> 
          <input type="date" name="data_final" date-input="d/m/y h:i:s" class="form-control form-control-sm" required>
        </div>
      </div>
      
    </div>

    <input class="btn btn-success" type="submit" value="Processar">
</form>
</div>


<script>
  $('select[multiple]').multiselect()
</script>