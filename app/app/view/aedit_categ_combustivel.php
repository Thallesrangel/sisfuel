<?php
ob_start();
  require_once "./layout/head.php";
  require_once "./layout/menu_top.php";
  require_once "./layout/menu_lateral.php"; 
  
  include_once("../controller/ControllerCatCombustivel.php");
    

if(isset($_GET['id_combustivel'])){
  $id = (int)$_GET['id_combustivel'];
} else {
  $id = 0;
}

$nome = "";
$email = "";

if(intval($id) != 0){
  $init = new ControllerCatCombustivel();
  $init->setId($id);
  $result = $init->buscar_id($init);
  
  if (count($result) > 0) {
    $id = $result['id_combustivel'];
    $nome = $result['categoria_combustivel'];
  
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
			<input type="text" name="categoria_combustivel" value ="<?php echo ($nome) ?>">
  
			<input type="submit"  value="Atualizar">
	</form>
</div>

<?php

if(isset($_POST['categoria_combustivel'])){
  
    if(isset($_POST['categoria_combustivel'])){
    $id = ($_GET['id_combustivel']);

    $nome = trim($_POST['categoria_combustivel']);
  } else {
    $nome = "";
  }

  $d = new ControllerCatCombustivel();  //Bao Usuario Ã© a classe do controlador
  $d->setId($id);
  $d->setNome($nome);
  $cadastrar = $init->atualizar($d);

  if($cadastrar){
    echo "ola";
    // 4 = Registro(s) excluÃ­do(s) com sucesso.
    header("Location: categoria_combustivel.php?status_cadastro=6");
  }else{
    // 5 = Erro ao tentar cadastrar
    header("Location: categoria_combustivel.php?status_cadastro=5");
  }
}
?>

<?php
    require_once "./layout/footer.php";
?>






