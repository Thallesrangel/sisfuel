
<?php

use App\controller\ControllerManutencaoVeiculo;

$manutencao = new ControllerManutencaoVeiculo();
$manutencao = $manutencao->listar($manutencao);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>


<div class="container">
  <div class="starter-template height-100">

    <h4>Controle de Manutenções</h4>
    <p style="float:left">
    <a href="<?=DIRPAGE?>/manutencao/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Veículo</th>
            <th>Fornecedor</th>
            <th title="Tipo de Manutenção">Tipo</th>
            <th>Vencimento</th>
            <th>Valor</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($manutencao != ""){
              foreach ($manutencao as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['titulo']?></td>
                    <td><?=strtoupper($value['placa'])?></td>
                    <td><?=$value['razao_social']?></td>
                    <td><?=$value['tipo_manutencao']?></td>
                    <td><?=date("d/m/Y", strtotime($value['data_vencimento']));?></td>
                    <td><?=$value['valor']?></td>
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