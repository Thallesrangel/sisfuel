<?php
    use App\controller\ControllerVeiculo;
   // Objeto Veículos
   $veiculos = new ControllerVeiculo();
   $veiculos = $veiculos->listar($veiculos);
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros Relatório Movimento de Entrada</h4>
  
<form action="<?=DIRPAGE.'/relatorio_movimento_entrada/render'?>" method="POST">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <span>Veículo</span> 
                <select class="form-control form-control-sm" name="veiculo" required>
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
      <div class="col-2">
        <div class="form-group">
          <span>Data Inicial</span> 
          <input type="date" name="data_inicial" value="<?=date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) )?>" class="form-control form-control-sm" required>
          </div>  
        </div>
      
      <div class="col-2">
        <div class="form-group">
          <span>Data Final</span> 
          <input type="date" name="data_final" value="<?=date("Y-m-d");?>" class="form-control form-control-sm" required>
        </div>
      </div>
    </div>

    <input class="btn btn-success" type="submit" value="Filtrar">

</form>
</div>