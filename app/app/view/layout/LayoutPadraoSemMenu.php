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
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
  
    <link rel="shortcut icon" href="<?=DIRIMG.'icon.png'?>">
  
    <title><?= $this->getTitle() ?></title>
    
    <?php
      # Adiciona mais informacoes no head se necessario
      echo $this->addHead();
    ?>
    
  </head>

  <body>

  <div class="header">
    
    <?php
      # Adiciona header
      echo $this->addHeader();
    ?>

  </div>

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
     <!-- Footer Padrao para todas as paginas -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
   
     <script>
       feather.replace()
     </script>
  </div>
   
</html>