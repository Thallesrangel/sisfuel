<?php
  Use App\model\Conexao;
?>
<div class="container">
<div class="starter-template height-100">
  <h4>Filtros | Relatório Fornecedor</h4>
  
<form action="<?=DIRPAGE.'/relatorio-fornecedor/render'?>" method="POST">
    <div class="row">

      <div class="col-sm-12 col-md-2 col-lg-3 ml-5">
        <div class="form-group">
          <span>Área Atuação *</span><br>
          <select class="form-control form-control-sm" name="atuacao[]" multiple required>
            <?php
            $pdo = Conexao::getConn();
            $sql = "SELECT * FROM tbfornecedor_atuacao";
            $resultado = $pdo->query($sql);

            foreach($resultado as $value){
              $idAtuacao =  $value['id_area_atuacao'];
              $atuacao =  $value['area_atuacao'];
            ?>
            <option value="<?= $idAtuacao ?>"> <?php echo (ucwords($atuacao))?> </option>
            <?php }?>
          </select>
        </div>
        <input class="btn btn-success" type="submit" value="Processar">
    </div>

</form>
</div>

<script>
  $('select[multiple]').multiselect()
</script>