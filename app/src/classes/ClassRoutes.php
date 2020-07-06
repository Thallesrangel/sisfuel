<?php

namespace Src\classes;

use Src\traits\UrlParser;

class ClassRoutes
{
    use UrlParser;

    private $rota;

    # Método de retorno da rota 
    public function getRota() {
        $url = $this->parserUrl();
        $indice = $url[0];
        # ROUTES
        $this->rota = array(
        ""                        =>  "ControllerHome",
        "home"                    =>  "ControllerHome",
        "categoriaveiculo"        =>  "ControllerCatModelo",
        "movimento-entrada"       =>  "ControllerMovEntrada",
        "movimento_saida"         =>  "ControllerMovSaida",
        "movimento-transito"      => "ControllerMovTransito",
        "seguro"                  =>  "ControllerSeguro", 
        "categoria_veiculo"       =>  "ControllerCatVeiculo",
        "fabricante"              =>  "ControllerFabricante",
        "categoria_combustivel"   =>  "ControllerCatCombustivel",
        "relatorios"              =>  "ControllerRelatorio",
        "relatorios-abastecimentos" => "ControllerRelatorioAbastecimentos",
        "abastecimento"           =>  "ControllerAbastecimento",
        "suporte"                 =>  "ControllerSuporte",
        "usuario"                 =>  "ControllerUsuario",
        "motorista"               =>  "ControllerMotorista",
        "ticket"                  =>  "ControllerTicket",
        "veiculo"                 =>  "ControllerVeiculo",
        "ipva"                    =>  "ControllerIpva",
        "fornecedor"              =>  "ControllerFornecedor",
        "tanque"                  =>  "ControllerTanque",
        "configuracao"            =>  "ControllerConfiguracao",
        "manutencao"              =>  "ControllerManutencaoVeiculo",
        "login"                   =>  "ControllerLogin",
        "logout"                  =>  "ControllerLogout",
        "cliente"                 =>  "ControllerCliente",
        "cartao-virtual"          => "ControllerCartaoVirtual",
        "modelo-veiculo"          => "ControllerModeloVeiculo",
        
        # Controllers com prefixo - Relatorio
        "relatorio_manutencao_veiculo" => "RelatorioManutencaoVeiculo",
        "relatorio_cartao_virtual" => "RelatorioCartaoVirtual",
        "relatorio-ipva" => "RelatorioIpva",
        "relatorio_ticket_abastecimento" => "RelatorioTicket",
        "relatorio-seguro" => "RelatorioSeguro",
        "relatorio_abastecimento" => "RelatorioAbastecimento",
        "relatorio_fornecedor" => "RelatorioFornecedor",
        "relatorio_motorista" => "RelatorioMotorista",
        "relatorio_veiculo" => "RelatorioVeiculo",
        "relatorio_usuario" => "RelatorioUsuario",
        "relatorio_tanque" => "RelatorioTanque",
        "relatorio_movimento_entrada" => "RelatorioMovEntrada",
        "relatorio_movimento_saida" => "RelatorioMovSaida",
        "relatorio-movimento-transito" => "RelatorioMovTransito",
    );
    
        # Verifica se URL digitada (1º indice do array) tem dentro do array rota
        if (array_key_exists($indice, $this->rota)) {
            # caso a rota exista
            if (file_exists (DIRREQ."/app/controller/{$this->rota[$indice]}.php") ) {
                return $this->rota[$indice];
                
            } else {
                # Caso arquivo não exista mas exista a rota
                return "ControllerHome";
            };   
            
        } else {
            # Caso nao exista o controlador digitado 
            return "Controller404";
        }
    }

}