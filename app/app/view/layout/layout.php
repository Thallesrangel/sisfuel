<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= DIRCSS . 'bootstrap.4.1.min.css'?>">
    <link rel="stylesheet" href="<?= DIRCSS . 'style.css'?>">
    <meta name="author" content="Thalles Rangel Lopes">
    <meta name="description" content="<?= $this->getDescription() ?>">
    <meta name="keywords" content="<?= $this->getKeywords()?>">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="reply-to" content="rangelthr@gmail.com">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="<?=DIRJS?>jquery.mask.min.js"></script>
    <script src="<?=DIRJS?>script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="shortcut icon" href="<?=DIRIMG.'icon.png'?>">

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <title><?= $this->getTitle() ?></title>
  
    <?php
      # Adiciona mais informacoes no head se necessario
      echo $this->addHead();
    ?>
  </head>
  <body>

  <?php
  require_once DIRREQ."/app/view/layout/sidebar.php";
  require_once DIRREQ."/app/view/layout/navbar.php";
  ?>
  
  <div class="container">
    <ul class="nav p-2 pl-3 breadcrumb">
      <li class='nav-item'>
      <?php $this->addBreadCrumb(); ?>
      </li> 
    </ul>
  </div>

  
    <?php  
    # Adiciona header
    echo $this->addHeader();
    ?>

  <div class="main">
  
    <?php
    # Adiciona header
    echo $this->addMain();
    
    ?>
  </div>

  <div class="footer">
   
    <?php
      # Adiciona footer
      echo $this->addFooter();
    ?>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
      
      <script>
        feather.replace()
      </script>


      <script>
        $('#sidebarCollapse').on('click', function () {
          // open or close navbar
          $('#sidebar').toggleClass('active');
          // close dropdowns
          $('.collapse.in').toggleClass('in');
          // and also adjust aria-expanded attributes we use for the open/closed arrows
          // in our CSS
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
      });
      </script>
  </div>

</html>