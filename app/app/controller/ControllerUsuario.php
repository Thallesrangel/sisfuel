<?php

namespace App\Controller;

if (!isset($_SESSION)) {
	session_start();
}

use Src\classes\ClassRender;
use Src\interfaces\InterfaceView;
#Action
use App\Action\Ausuario;
# Model
use App\model\ClsUsuario;
use App\model\DaoUsuario;

class ControllerUsuario extends ClsUsuario
{
	# Retorna o main da view/Ticket
	public function list()
    {   
		$breadcrumb = [
			'Início' => 'home',
			'usuario' => 'usuario/list',
			'Listagem' => ''
		];

        if ($_SESSION['nivel'] == 2) {
			# Composição
            $render = new ClassRender();
            $render->setTitle("Sisfuel APP - Lista de Usuários");
            $render->setDescription("usuarios");
			$render->setKeyWords("sisfuel");
			# Pasta na View
			$render->setDir("Usuario");
			$render->setBreadCrumb($breadcrumb);
            $render->renderLayout();
        } else {
			die("Você não tem permissão para acessar esta página");
		}
	}
	
	# Retorna o main da View/Registrar_ticket
	public function novo()
	{  	
		$breadcrumb = [
			'Início' => '',
			'usuario' => 'usuario/',
			'Novo' => ''
		];

		if ($_SESSION['nivel'] == 2) {
			# Composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Novo usuário");
			$render->setDescription("Novo usuário");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Registrar_usuario");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		} else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da View/Registrar_ticket
	public function editar()
	{  	
		$breadcrumb = [
			'Início' => '',
			'usuario' => 'usuario/',
			'Editar' => ''
		];

		if ($_SESSION['nivel'] == 2) {
			# Composição
			$render = new ClassRender();
			$render->setTitle("Sisfuel App - Editar ticket");
			$render->setDescription("Editar ticket");
			$render->setKeyWords("sisfuel");
			# Pasta na view
			$render->setDir("Editar_usuario");
			$render->setBreadCrumb($breadcrumb);
			$render->renderLayout();
		}  else {
			die("Você não tem permissão para acessar esta página");
		}
	}

	# Retorna o main da View/Recuperar_senha
	public function recuperar()
	{  	
		# Composição
		$render = new ClassRender();
		$render->setTitle("Sisfuel App - Recuperar usuário");
		$render->setDescription("Recuperar usuário");
		$render->setKeyWords("sisfuel");
		# Pasta na view
		$render->setDir("Recuperar_usuario");
		$render->renderLayout();
	}

	# Quando um novo cliente é cadastrado
	function cadastrarExterno(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->cadastrarExterno($objClass);		
	}

	# Quando usuario cria outro usuario dentro do sistema
	function cadastrarInterno(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->cadastrarInterno($objClass);		
	}

	function atualizar(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->atualizar($objClass);
	}
	
	//Libera o acesso ao usuario de id= 3 (aguardando acesso) para selecionado
	function definirPermissao(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->definirPermissao($objClass);
	}
	
	//Lista todos os usuarios liberados
	function listar(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->listar($objClass);
	}

	//Lista de usuarios aguardando acesso
	function listarLiberar(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->listarLiberar($objClass);
	}

	function deletar(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->deletar($objClass);
	}

	function buscarUsuario(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->buscarUsuario($objClass);
	}

	function count(ClsUsuario $objClass)
	{
		$objItf = new DaoUsuario();
		return $objItf->count($objClass);
	}

	# Action Registrar

	public function registrar()
	{	
		# Absctract class Asuporte method excluirAction
		Ausuario::registrarUsuarioInterno();
	}
	
}