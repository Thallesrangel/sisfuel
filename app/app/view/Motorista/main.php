<?php

use App\controller\ControllerMotorista;

$consultaMotorista = new ControllerMotorista();
$motoristas = $consultaMotorista->listar($consultaMotorista);

require_once(DIRREQ.'/app/view/layout/mensagens.php');
unset($_SESSION["mensagem"]);

?>
<div class="container">
<div class="starter-template  height-100">

      <h4>Motoristas</h4>
      <p align="left">
      <a data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
         Novo</a>
      </p>

      <table class="table table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>CNH</th>
            <th>CPF</th>
            <th>Vencimento CNH</th>
            <th>Nascimento</th>
             <th>Ação</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($motoristas != ""){
              foreach ($motoristas as $key => $value) {
            ?>
                <tr>
                    <td><?=$value['id_motorista']?></td>
                    <td><?=ucwords($value['nome_motorista'])?></td>
                    <td><?=$value['cnh']?></td>
                    <td><?=$value['cpf']?></td>
                    <td><?=date("d/m/Y", strtotime($value['data_vencimento_cnh']));?></td>
                    <td><?=date("d/m/Y", strtotime($value['data_nascimento']));?></td>
                    <td>
                      <a href="<?=DIRPAGE?>/motorista/alterar/<?=$value['id_motorista']?>" title="Alterar Registro">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                        
                      <a href="<?=DIRPAGE?>/motorista/excluir/<?=$value['id_motorista']?>" title="Excluir Registro">
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Motorista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=DIRPAGE.'/motorista/novo/'?>" method="POST">
                
                  <div class="form-group">
                      <input placeholder="Nome completo" type="text" name="nome" class="form-control">
                  </div>

                  <div class="form-group">
                      <input placeholder="CNH"  maxlength='15' type="text" name="cnh" class="form-control">
                  </div>

                  <div class="form-group">
                    <span> Vencimento CNH</span>
                      <input type="date" name="vencimento_cnh" class="form-control quantidade">
                  </div>

                  <div class="form-group">
                      <input placeholder="CPF" type="text" name="cpf" class="form-control cpf">
                  </div>

                  <div class="form-group">
                    <span> Data de Nascimento</span>
                      <input type="date" name="data_nascimento" class="form-control data">
                  </div>

                  <div class="form-group">
                    <span> E-mail</span>
                      <input type="e-mail" name="email" class="form-control">
                  </div>

                  <div class="form-group">
                    <span> Senha</span>
                      <input type="password" name="senha" class="form-control">
                  </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <input class="btn btn-success" type="submit" value="Cadastrar">
                    <input class="btn btn-danger" type="reset" value="Limpar">
                </div>
                </form>
            </div>
        
        </div>
    </div>
</div>
</div>

<!-- Script Usado para editar com dois clicks na linha-->
<script>
$('tr').dblclick(function(){
  var tr = $(this).closest("tr");
  var id = tr.find("td:eq(0)").text();
  window.location = "<?=DIRPAGE?>/motorista/editar/"+id;
});
</script>