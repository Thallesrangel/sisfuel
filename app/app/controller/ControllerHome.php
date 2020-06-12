<?php

namespace App\controller;

session_start();

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;

class ControllerHome
{
    public function __construct()
    { 
        $breadcrumb = [
            'Início' => '',
        ];
        if (isset($_SESSION['id_usuario'])) {
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Página Inicial");
            $render->setDescription("Página inicial");
            $render->setKeyWords("sisfuel");
            $render->setDir("home");
            $render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        } else {
            header("Location:".DIRPAGE.'/login');
        }
    }
}