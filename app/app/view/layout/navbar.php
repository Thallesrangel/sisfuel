<div class="d-flex flex-column">
<nav class="navbar-expand navbar-light bg-white  mb-2 static-top shadow-sm">
<!--   
  <button type="button" id="sidebarCollapse" class="btn btn-default btn-sm">
    <i data-feather="menu"></i>
  </button> -->

  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav navbar-left">
      <li class="nav-item">
          <li class=nav-link>
         
            <?php if($_SESSION['id_tipo'] == 1){
            ?>
              <span class="nav-link"><b>Usuário: </b><?= $_SESSION['nome_usuario'] .' - <b>Cliente:</b>'. $_SESSION['razao_social_cliente'] ?></span>  
            <?php
            } else {
            ?>
              <span class="nav-link"><b>Usuário: </b><?= $_SESSION['nome_usuario']?></span>    
            <?php
            }
           ?>
          </li>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item list-unstyled ">
        <a class="nav-link" href="<?=DIRPAGE?>"><i data-feather="home"></i><span class="sr-only">(current)</span></a>
      </li>

      <div class="btn-group">
        
        <li class="nav-item" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a class="nav-link" href="#"><i data-feather="bell"></i></a>
        </li>

        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">CNH vencendo</a>
          <a class="dropdown-item" href="#">Troca de óleo</a>
          <a class="dropdown-item" href="#">Combustível baixo</a>
        </div>
      </div>
      
      <li class="nav-item">
        <a class="nav-link" href="<?=DIRPAGE.'/configuracao/index'?>"><i data-feather="settings"></i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=DIRPAGE.'/logout'?>"><i data-feather="log-out"></i></a>
      </li>

    </ul>
  </div>
</nav>