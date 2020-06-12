<?php
use App\controller\ControllerTicket;

$ticket = new ControllerTicket();
$ticket = $ticket->listar($ticket);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>
<div class="container">
  <div class="starter-template height-100">

    <h4>Ticket de Abastecimento</h4>
    <p style="float:left">
    <a href="<?=DIRPAGE?>/ticket/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>Ticket</th>
            <th>Fornecedor</th>
            <th>Veículo</th>
            <th>Combustível</th>
            <th title="Quantidade">Qtd</th>
            <th>Motorista</th>
            <th>Data</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($ticket != ""){
              foreach ($ticket as $key => $value) {
                $dataEntrada = date_create($value['data_entrada']);
            ?>
                <tr>
                    <td><?=$value['id_ticket']?></td>
                    <td><?=ucwords($value['razao_social'])?></td>
                    <td><?=$value['placa']?></td>
                    <td><?=$value['categoria_combustivel']?></td>
                    <td><?=$value['quantidade']?></td>
                    <td><?=ucwords($value['nome_motorista'])?></td>
                    <td><?=date_format($dataEntrada,'d/m/Y');?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/relatorio_ticket_abastecimento/gerar/<?=$value['id_ticket']?>"  title="Visualizar detalhes">
                      <i data-feather="file" class="iconArquivo"></i>
                      </a>
                      <a href="<?=DIRPAGE?>/ticket/editar/<?=$value['id_ticket']?>" title="Editar Registro">
                      <i data-feather="edit-2" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/ticket/excluir/<?=$value['id_ticket']?>" title="Excluir Registro">
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
  window.location = "<?=DIRPAGE?>/ticket/editar/"+id;
});
</script>