<?php

use App\controller\ControllerFornecedor;
use App\model\Conexao;
$fornecedor = new ControllerFornecedor();
$fornecedor = $fornecedor->listar($fornecedor);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>
<div class="container">
<div class="starter-template height-100">

      <h4>Fornecedor</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#modal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
         Novo</a>
      </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
            <th>Razão Social</th>
            <th>Área de Atução</th>
            <th>CNPJ</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($fornecedor != ""){
              foreach ($fornecedor as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_fornecedor']?></td>
                    <td><?=ucwords($value['razao_social'])?></td>
                    <td><?=ucwords($value['area_atuacao'])?></td>
                    <td class="cnpj"><?=$value['cnpj']?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/fornecedor/alterar/<?=$value['id_fornecedor']?>" alt="Editar Cadastro" title="Alterar Fornecedor">
                        <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/fornecedor/excluir/<?=$value['id_fornecedor']?>" alt="Excluir Cadastro" title="Excluir Fornecedor">
                        <i data-feather="trash" class="iconExcluir"></i>
                      </a>
                    </td>
                </tr>
              <?php
              }
            }
            ?>
        </tbody>
      </table>
      <div id='response'></div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Fornecedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" id="cadUsuario" method="POST">
                <div class="form-group">
                    <input placeholder="Razão Social" id="razaosocial" type="text" name="razaosocial" class="form-control form-control-sm">
                </div>

                <div class="form-group">
                    <input placeholder="CNPJ" type="text" id="cnpj" name="cnpj" class="form-control form-control-sm cnpj">
                </div>

                <div class="form-group">
                    <label for="area_atuacao">Área de Atuação</label><br>
                    <select class="form-control js-select" id="area_atuacao" name="area_atuacao">
                    <?php
                        #SQL DIRETO
                        $pdo = Conexao::getConn();
                        $sql = "SELECT id_area_atuacao, area_atuacao FROM tbfornecedor_atuacao";
                        $resultado = $pdo->query($sql);

                        foreach($resultado as $value){
                          $idAreaAtuacao =  $value['id_area_atuacao'];
                          $areaAtuacao =  $value['area_atuacao'];
                        ?>
                        <option value="<?= $idAreaAtuacao ?>"><?php echo ucwords($areaAtuacao)?></option>
                        <?php }?>
                    </select>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                    <input class="btn btn-success btn-sm" id="submit" type="button" value="Cadastrar">
                    <input class="btn btn-danger btn-sm" type="reset" value="Limpar">
                </div>
                </form>
            </div>
        
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
// AJAX de cadastro Fornecedor
$('#submit').mouseout(function() {

  var razaosocial = $("#razaosocial").val();
  var cnpj = $("#cnpj").val();
  var area_atuacao = $("#area_atuacao").val();
  var dataString = {razaosocial:razaosocial, cnpj:cnpj, area_atuacao:area_atuacao};
 
  $.ajax({
    type: 'post',
    url: "<?=DIRPAGE.'/fornecedor/novo/'?>",
    data: dataString,
    dataType : 'json',
    cache: false,
  });
  $('#modal').modal('hide');
});


</script>

<!-- Script Usado para editar com dois clicks na linha-->
<script>
$('tr').dblclick(function(){
  var tr = $(this).closest("tr");
  var id = tr.find("td:eq(0)").text();
  window.location = "<?=DIRPAGE?>/fornecedor/editar/"+id;
});
</script>