<?php
    use App\controller\ControllerFornecedor;
    use App\controller\ControllerVeiculo;
    use App\controller\ControllerMotorista;
    use App\controller\ControllerCatCombustivel;

    // Objeto Fornecedor
    $fornecedores = new ControllerFornecedor();
    $fornecedores = $fornecedores->listar($fornecedores);

    // Objeto Veículos
    $veiculos = new ControllerVeiculo();
    $veiculos = $veiculos->listar($veiculos);

    // Objeto Motorista
    $motoristas = new ControllerMotorista();
    $motoristas = $motoristas->listar($motoristas);

    // Objeto Tanque de Combustivel
    $combustivel = new ControllerCatCombustivel();
    $combustivel = $combustivel->listar($combustivel);
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório Abastecimento</h4>
  
<form action="<?=DIRPAGE.'/relatorio-abastecimento/render'?>" method="POST">
    <div class="row">


        <div class="col-3">
            <div class="form-group">
                <span>Fornecedor</span> 
                <select class="form-control form-control-sm" id="fornecedor"  name="fornecedor[]" multiple required>
                <?php

                foreach ($fornecedores as $fornecedor) {
                    $idFornecedor =  $fornecedor['id_fornecedor'];
                    $nomeFornecedor =  ucwords($fornecedor['razao_social']);
                    
                ?>

                <option value="<?=$idFornecedor?>"> <?=$nomeFornecedor?> </option>
                <?php }?>
                </select>
            </div>  
        </div>

      <div class="col-3">
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

      <div class="col-3">
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

        <div class="col-3">
            <div class="form-group">
                <span>Combustível</span> 
                <select class="form-control form-control-sm" name="combustivel[]" multiple required>
                <?php

                foreach ($combustivel as $combustiveis) {
                    $idCombustivel =  $combustiveis['id_combustivel'];
                    $combustivel =  $combustiveis['categoria_combustivel'];

                ?>

                <option value="<?= $idCombustivel ?>"> <?php echo $combustivel?> </option>
                <?php }?>
                </select>
            </div>  
        </div>

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