<?php
Use App\model\Conexao;
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório Veículo</h4>
  
<form action="<?=DIRPAGE.'/relatorio-veiculo/render'?>" method="POST">
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="form-group">
                <span>Modelo *</span><br>
                <select class="form-control form-control-sm" name="modelo[]" multiple required>
                    <?php
                    $pdo = Conexao::getConn();
                    $sql = "SELECT * FROM tbveiculo_modelo";
                    $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idFabricante =  $value['id_modelo'];
                        $fabricante =  $value['modelo_veiculo'];
                    ?>
                    <option value="<?= $idFabricante ?>"> <?php echo (ucwords($fabricante))?> </option>
                    <?php }?>
                </select>
            </div>
        </div>


        <div class="col-sm-12 col-md-2 col-lg-2 ml-5">
            <div class="form-group">
                <span>Categorias *</span><br>
                <select class="form-control form-control-sm" name="categoria[]" multiple required>
                    <?php
                    $pdo = Conexao::getConn();
                    $sql = "SELECT * FROM tbveiculo_categoria";
                    $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idCategoria =  $value['id_categoria_veiculo'];
                        $categoria =  $value['categoria_veiculo'];
                    ?>
                    <option value="<?= $idCategoria ?>"> <?php echo (ucwords($categoria))?> </option>
                    <?php }?>
                </select>
            </div>
        </div>

        <div class="col-sm-12 col-md-2 col-lg-2 ml-5">
            <div class="form-group">
                <span>Tipo Veículos *</span><br>
                <select class="form-control form-control-sm" name="tipo[]" multiple required>
                    <?php
                    $pdo = Conexao::getConn();
                    $sql = "SELECT * FROM tbveiculo_tipo";
                    $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idTipo =  $value['id_tipo_veiculo'];
                        $tipo =  $value['tipo_veiculo'];
                    ?>
                    <option value="<?= $idTipo ?>"> <?php echo (ucwords($tipo))?> </option>
                    <?php }?>
                </select>
            </div>
        </div>


        <div class="col-sm-12 col-md-2 col-lg-2 ml-5">
            <div class="form-group">
                <span>Combustíveis *</span><br>
                <select class="form-control form-control-sm" name="combustivel[]" multiple required>
                    <?php
                    $pdo = Conexao::getConn();
                    $sql = "SELECT * FROM tbcategoria_combustivel";
                    $resultado = $pdo->query($sql);

                    foreach($resultado as $value){
                        $idTipo =  $value['id_combustivel'];
                        $tipo =  $value['categoria_combustivel'];
                    ?>
                    <option value="<?= $idTipo ?>"> <?php echo (ucwords($tipo))?> </option>
                    <?php }?>
                </select>
            </div>
        </div>

    </div>
    <div class="row">

      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span>Fabricação Inicial *</span> 
          <input type="date" name="data_inicial" date-input="d/m/y" class="form-control form-control-sm" required>
        </div>  
      </div>
    
      <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="form-group">
          <span>Fabricação Final *</span> 
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