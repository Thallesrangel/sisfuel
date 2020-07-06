<div class="wrapper">
   	<nav id="sidebar" style="overflow-y:auto;">
	    <div class="sidebar-header d-flex justify-content-center">
			<a href="<?=DIRPAGE?>"><img src="<?=DIRIMG . 'logo.png'?>"></a> 
		</div>		
   		<ul class="list-unstyled components">
		
		<?php if (in_array(1, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['flag_tanque'] == 1) {?>
			<li>
				<a href="<?=DIRPAGE?>/movimento-entrada/list"><i data-feather="arrow-up-circle"></i> Movimento de Entrada </a>
			</li>
		<?php } ?>
		
		<?php if (in_array(2, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['flag_tanque'] == 1) {?>
			<li>
				<a href="<?=DIRPAGE?>/movimento_saida/list"><i data-feather="arrow-down-circle"></i> Movimento de Saída</a>
			</li>
		<?php } ?>
		
		<?php if (in_array(4, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['flag_tanque'] == 1) {?>
			<li>
				<a href="<?=DIRPAGE?>/movimento-transito/list"><i data-feather="compass"></i> Movimento em Trânsito</a>
			</li>
		<?php } ?>
		
		<?php if (in_array(5, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['id_tipo'] == 1) {?>
			<li>
   				<a href="<?=DIRPAGE?>/ticket/list"><i data-feather="bookmark"></i> Ticket Abastecimento</a>
   			</li>
		<?php } ?>

		<?php if (in_array(6, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['id_tipo'] == 1) {?>
			<li>
   				<a href="<?=DIRPAGE?>/cartao-virtual/list"><i data-feather="credit-card"></i> Cartão virtual</a>
   			</li>
		<?php } ?>

		<?php if (in_array(3, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['id_tipo'] == 2) {?>
			<li>
				<a href="<?=DIRPAGE?>/abastecimento/list"><i data-feather="truck"></i> Abastecimento</a>
			</li>
		<?php } ?>

			<li>
   				<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i data-feather="folder-plus"></i> Cadastro Geral</a>
   				<ul class="collapse list-unstyled" id="pageSubmenu">
   					<li>
   						<a href="<?=DIRPAGE?>/veiculo/list"><i data-feather="chevron-right"></i> Veículos</a>
   					</li>
					   
					<li>
   						<a href="<?=DIRPAGE?>/fornecedor/list"><i data-feather="chevron-right"></i> Fornecedores</a>
   					</li>

					<li>
   						<a href="<?=DIRPAGE?>/tanque/list"><i data-feather="chevron-right"></i> Tanques</a>
   					</li>   

   					<li>
   						<a href="<?=DIRPAGE?>/motorista/list"><i data-feather="chevron-right"></i> Motoristas</a>
   					</li>

					<li>
   						<a href="<?=DIRPAGE?>/fabricante/list"><i data-feather="chevron-right"></i> Fabricantes dos Veículos</a>
					</li>
					   
					<li>
   						<a href="<?=DIRPAGE?>/modelo-veiculo/list"><i data-feather="chevron-right"></i> Modelos dos Veículos</a>
					</li>

					<li>
   						<a href="<?=DIRPAGE?>/categoria_veiculo/list"><i data-feather="chevron-right"></i> Categoria Veículo</a>
   					</li>

   					<li>
   						<a href="<?=DIRPAGE?>/categoria_combustivel/list"><i data-feather="chevron-right"></i>Categoria Combustíveis</a>
   					</li>
					   
   				</ul> 
   			</li>

		 <?php if (in_array(4, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2 && $_SESSION['flag_tanque'] == 1) {?>
			<li>
				<a href="<?=DIRPAGE?>/relatorios-abastecimentos/list"><i data-feather="pie-chart"></i> Relatório Abastecimentos</a>
			</li>
		<?php } ?>

		<li>
			<a href="<?=DIRPAGE?>/relatorios/list"><i data-feather="clipboard"></i> Relatórios</a>
		</li>
			   
		<?php if (in_array(7, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {?>
			<li>
   				<a href="<?=DIRPAGE?>/seguro/list"><i data-feather="shield"></i> Seguros</a>
			</li>
		<?php } ?>
		
		<?php if (in_array(8, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {?>
			<li>
   				<a href="<?=DIRPAGE?>/ipva/list"><i data-feather="file-minus"></i> IPVA</a>
			</li>
		<?php } ?>

		<?php if (in_array(9, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {?>
			<li>
   				<a href="<?=DIRPAGE?>/manutencao/list"><i data-feather="tool"></i> Manutenção</a>
			</li>
		<?php } ?>
		
		<?php if (in_array(10, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {?>
			<li>
   				<a href="<?=DIRPAGE?>/usuario/list"><i data-feather="users"></i> Usuários</a>
   			</li>
		<?php } ?>
		
		<?php if (in_array(11, $_SESSION['permissoes']) OR $_SESSION['nivel'] == 2) {?>
			<li>
   				<a href="<?=DIRPAGE?>/suporte/list"><i data-feather="message-square"></i> Suporte</a>
   			</li>
		<?php } ?>
		
   		</ul>

   	</nav>