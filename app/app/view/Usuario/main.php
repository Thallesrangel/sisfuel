<?php
use App\controller\ControllerUsuario;
$usuario = new ControllerUsuario();
$usuarios = $usuario->listar($usuario);
?>
<div class="container">
<div class="starter-template height-100">
      <p>
      <a href="<?=DIRPAGE?>/usuario/novo" class="btn btn-default btn-sm btnCadastrar" alt="Incluir Cadastro" title="Incluir Cadastro">
        Novo</a>
      </p>
      <table class="table  table-sm table-hover" id="table"> 
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Acesso Atual</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if($usuarios != ""){
              foreach ($usuarios as $key => $value) {
            ?>  
                <tr id="conteudo">
                    <td><?=$value['id_usuario']?></td>
                    <td><?=$value['nome_usuario']?></td>
                    <td><?=$value['email']?></td>
                    <td><?=$value['nome_acesso']?></td>
                    <td>
                      <a href="aedit_acesso.php?id_usuario=<?=$value['id_usuario']?>" alt="Editar Cadastro" title="Editar Cadastro">
                      <i data-feather="edit" class="iconEditar"></i>
                      </a>
                      &nbsp; 
                      <a href="<?=DIRPAGE?>/usuario/excluir/<?=$value['id_usuario']?>" alt="Excluir Cadastro">
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
  window.location = "<?=DIRPAGE?>/usuario/editar/"+id;
});
</script>