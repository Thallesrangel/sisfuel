<div class="d-flex flex-column">
<nav class="navbar-expand navbar-light bg-white  mb-2 static-top shadow-sm">

  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav navbar-left">
      <li class="nav-item">
          <li class="nav-link">
            <button type="button" id="sidebarCollapse" class="btn btn-link btn-sm">
              <i data-feather="menu"></i>
            </button> 
          </li>
          <li class=nav-link>

            <?php if($_SESSION['id_tipo'] == 1){
            ?>
              <span class="nav-link"><b>Cliente:</b><?= $_SESSION['razao_social_cliente'] ?></span>  
            <?php
            } else {
            ?>
                
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
           <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Combustível baixo</a>
        </div>
      </div>
      
  
      <div class="dropdown">
        
  
        <li class="nav-item" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a class="nav-link" href="#"><i data-feather="user"></i> <?=$_SESSION['nome_usuario']?> </a>
        </li>
        
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="nav-link" href="<?=DIRPAGE.'/configuracao/index'?>"><i data-feather="settings"></i> Configuração</a>
          <div class="dropdown-divider"></div>
          <a class="nav-link" href="<?=DIRPAGE.'/logout'?>"><i data-feather="log-out"></i> Logout</a>
        </div>
      </div>

    </ul>
  </div>
</nav>