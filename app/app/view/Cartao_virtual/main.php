
<?php


use App\controller\ControllerCartaoVirtual;

$cartoes = new ControllerCartaoVirtual();
$cartoes = $cartoes->listar($cartoes);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>


<div class="container">
  <div class="starter-template height-100">

  <h4>Cartão Virtual</h4>
    <p style="float:left">
    <a href="<?=DIRPAGE?>/cartao-virtual/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
    </p>

    <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
         
            <th>Motorista</th>
            <th>Validade Cartão</th>
            <th>Valor Limite</th>
            <th>Situação</th>
            <th>Renovação Automática</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if ($cartoes != "") {
              foreach ($cartoes as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_cartao']?></td>
                    <td><?=ucwords($value['nome_motorista'])?></td>
                    <td><?=date("d/m/Y", strtotime($value['data_validade']));?></td>
                    <td><?=$value['valor_limite']?></td>
                    <td><?=ucwords($value['cartao_situacao'])?></td>
                    <td><?=ucwords($value['cartao_renovacao'])?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/cartao-virtual/externo/<?=$value['id_cartao']?>">
                      <i data-feather="credit-card" class="iconCardCredit"></i>
                      </a>
                      
                      <a href="<?=DIRPAGE?>/cartao-virtual/editar/<?=$value['id_cartao']?>">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/cartao-virtual/excluir/<?=$value['id_cartao']?>">
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

<script>
$(document).ready( function () {
    $('#table').DataTable();
} );
</script>