<?php

session_start();
//verificar se há sessão
if ($_SESSION["usuario"] == "" || $_SESSION["usuario"] == NULL) {
  header("Location: ../index.php");
}
  require_once "./layout/head.php";
  require_once "./layout/sidebar.php";
  require_once "./layout/navbar.php";
?>

<div class="container">
  <h4>Ajustes Gerais</h4>
  
</div>
  
<?php
    require_once "./layout/footer.php";
?>