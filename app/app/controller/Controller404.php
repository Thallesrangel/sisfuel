<?php

namespace App\controller;

require_once (DIRREQ."/app/view/layout/head.php");

class Controller404
{
    public function __construct()
    {   
     ?>   

    <div class="container d-flex justify-content-center" style="margin-top:10%"> 
        <img src="<?= DIRIMG.'404.png'?>" class="img-fluid">
    </div>
    </br>
    <div class="container d-flex justify-content-center"> 
        <a href="<?= DIRPAGE.'/home'?>" class="btn btn-success">Página Inicial</a>
    </div>
    </body>
    <?php
    }
}