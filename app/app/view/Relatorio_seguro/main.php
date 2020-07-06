<?php
  use App\controller\ControllerVeiculo;
  use App\controller\ControllerFornecedor;

  // Objeto Fornecedor
  $fornecedores = new ControllerFornecedor;
  $fornecedores = $fornecedores->listarSeguradoras($fornecedores);

  // Objeto Veículos
  $veiculos = new ControllerVeiculo();
  $veiculos = $veiculos->listar($veiculos);

  Use App\model\Conexao;
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório IPVA</h4>
  
<form action="<?=DIRPAGE.'/relatorio-ipva/render'?>" method="POST">
    <div class="row">


        <div class="col-2">
            <div class="form-group">
                <span>Seguradoras *</span> 
                <select class="form-control form-control-sm" name="seguradora[]" multiple required>
                <?php
                foreach($fornecedores as $value){
                $idSeguradora =  $value['id_fornecedor'];
                $nomeSeguradora = $value['razao_social'];
                ?>
                <option value="<?= $idSeguradora ?>"> <?php echo $nomeSeguradora?> </option>
                <?php }?>
                </select>
            </div>  
        </div>

      <div class="col-2 ml-5">
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


      <div class="col-sm-12 col-md-2 col-lg-3 ml-5">
        <div class="form-group">
          <span>Situação</span><br>
          <select class="form-control form-control-sm" name="situacao[]" multiple required>
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
    <div class="row">

      <div class="col-2">
        <div class="form-group">
          <span>Data Inicial *</span> 
          <input type="date" name="data_inicial" date-input="d/m/y" class="form-control form-control-sm" required>
        </div>  
      </div>
    
      <div class="col-2">
        <div class="form-group">
          <span>Data Final *</span> 
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