<?php
namespace App\controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;

class ControllerModo
{
    # Retorna o main da view/modo
	public function __construct()
	{  	
		if (isset($_SESSION['id_usuario']))	{
			# composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Escolha um modo");
			$render->setDescription("Cartão Virtual");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Modo");
			$render->renderLayout();
	    }
    }

}