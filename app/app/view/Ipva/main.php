
<?php

use App\controller\ControllerIpva;

$entrada = new ControllerIpva();
$entrada = $entrada->listar($entrada);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>


<div class="container">
  <div class="starter-template height-100">
    <p style="float:left">
    <a href="<?=DIRPAGE?>/ipva/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th title="Placa do veículo">Veículo</th>
            <th title="Data de vencimento">Vencimento</th>
            <th>Valor</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($entrada != ""){
              foreach ($entrada as $key => $value) {
            ?>
                <tr>
                    <td><?=strtoupper($value['placa'])?></td>
                    <td><?=date("d/m/Y", strtotime($value['data_vencimento']));?></td>
                    <td>R$: <span class="valor-limite"><?=$value['valor']?></span></td>
                    <td><?=$value['situacao']?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/ipva/editar/<?=$value['id_ipva']?>">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/ipva/excluir/<?=$value['id_ipva']?>">
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
    </div>
  </div>
</div>

<!-- Script Usado para editar com dois clicks na linha-->
<script>
$('tr').dblclick(function(){
  var tr = $(this).closest("tr");
  var id = tr.find("td:eq(0)").text();
  window.location = "<?=DIRPAGE?>/movimento-entrada/editar/"+id;
});
</script>