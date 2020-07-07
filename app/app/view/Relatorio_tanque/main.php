<?php
    Use App\model\Conexao;
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório Tanque</h4>
  
<form action="<?=DIRPAGE.'/relatorio-tanque/render'?>" method="POST">
    <div class="row">

    <div class="col-sm-12 col-md-2 col-lg-3">
      <div class="form-group">
        <span>Combustível</span><br>
        <select class="form-control form-control-sm" name="combustivel[]" multiple required>
          <?php
          $pdo = Conexao::getConn();
          $sql = "SELECT * FROM tbcategoria_combustivel";
          $resultado = $pdo->query($sql);

          foreach($resultado as $value){
            $idCombustivel =  $value['id_combustivel'];
            $combustivel =  $value['categoria_combustivel'];
          ?>
          <option value="<?= $idCombustivel ?>"> <?php echo (ucwords($combustivel))?> </option>
          <?php }?>
        </select>
      </div>
    </div>
            
    </div>

    <input class="btn btn-success" type="submit" value="Processar">
</form>
</div>

<script>
  $('select[multiple]').multiselect()
</script>