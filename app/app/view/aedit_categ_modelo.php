<?php
session_start();

ob_start();
  require_once "./layout/head.php";
  require_once "./layout/menu_top.php";
  require_once "./layout/menu_lateral.php"; 
  
  include_once("../controller/ControllerCatModelo.php");
    

if(isset($_GET['id_modelo'])){
  $id = (int)$_GET['id_modelo'];
} else {
  $id = 0;
}

$nome = "";
$email = "";

if(intval($id) != 0){
  $init = new ControllerCatModelo();
  $init->setId($id);
  $result = $init->buscar_id($init);
  
  if (count($result) > 0) {
    $id = $result['id_modelo'];
    $nome = $result['nome_modelo'];
  
  } else {
    $id = 0;
    $nome = "";
    $email = "";
  }
}
?>

<div class="container">
	<form action="" method="POST" name="atualizar">
		<label">Editar</label>
												
      <p>id:<?php echo ($id) ?> </p>
			<input type="text" name="nome_modelo" value ="<?php echo ($nome) ?>">
  
			<input type="submit"  value="Atualizar">
	</form>
</div>

<?php

if(isset($_POST['nome_modelo'])){
  
    if(isset($_POST['nome_modelo'])){
    $id = ($_GET['id_modelo']);

    $nome = trim($_POST['nome_modelo']);
  } else {
    $nome = "";
  }

  $d = new ControllerCatModelo();
  $d->setId($id);
  $d->setNome($nome);
  $cadastrar = $init->atualizar($d);

  if ($cadastrar) {

    $_SESSION["mensagem"] = "editado_sucesso";
    header("Location: categoria_modelo.php");

  }else{

    $_SESSION["mensagem"] = "erro_editar";
    header("Location: categoria_modelo.php");
    
  }
}
?>

<?php
    require_once "./layout/footer.php";
?>






