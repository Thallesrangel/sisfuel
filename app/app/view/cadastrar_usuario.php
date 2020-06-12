<?php

session_start();
//verificar se há sessão
if ($_SESSION["usuario"] == "" || $_SESSION["usuario"] == NULL) {
  header("Location: ../index.php");
}
  require_once "./layout/head.php";
  require_once "./layout/sidebar.php";
  require_once "./layout/navbar.php";  
  require_once "../controller/ControllerUsuario.php"; 
?>

<div class="container">
  <h4>Cadastro de usuário</h4>
  
  <form action="acad_usuario.php" method="POST">
    <div class="row">
  
      <div class="col-3">
        <div class="form-group">
          <span>Permissão</span> 
            <select class="form-control form-control-sm" name="id_acesso">
            <?php
  
            $pdo = Conexao::getConn();
            $sql = "SELECT id_acesso, nome_acesso FROM tbnivel_acesso";
            $permissoes = $pdo->query($sql);
        
              foreach($permissoes as $permissao){
                $idAcesso =  $permissao['id_acesso'];
                $nomeAcesso =  $permissao['nome_acesso'];
              ?>
              <option value="<?= $idAcesso ?>"> <?php echo $nomeAcesso?> </option>
              <?php }?>
            </select>
          </div>  
        </div>
    </div>

    <div class="row">
      
      <div class="col-4">
        <div class="form-group">
          <span>Nome:</span>
          <input  maxlength="30" type="int"  placeholder="Digite o nome completo" name="nome" required class="form-control form-control-sm">
        </div>

        <div class="form-group">
          <label>E-mail</label>
          <input class="form-control form-control-sm" type="email" name="email" placeholder="Digite o e-mail do usuário" required />
        </div>


        <div class="form-group">
          <label>Senha</label>
          <input class="form-control form-control-sm" type="password" name="senha" placeholder="Digite uma senha provisória" required />
        </div>
      </div>

    </div>
    
    <a href="javascript:history.back()" class="btn btn-secondary btn-sm"">Voltar</a>
    <input id="solicitar" class="btn btn-success btn-sm" type="submit" value="Registrar">
  
  </form>
</div>

<script>
    function validaSenha(input) {
        if (input.value != document.getElementById('senha').value) {
            input.setCustomValidity('Repita a senha corretamente!');
            document.getElementById('msg-erro').style.display = "block"
        } else {
            input.setCustomValidity('');
            document.getElementById('msg-erro').style.display = "none"
        }
    }
    </script>
<?php
    require_once "./layout/footer.php";
?>

