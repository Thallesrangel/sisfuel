<?php

namespace Src\Traits;

# Classe auxiliar para tratar dados antes de inserir no banco de dados
trait TratarDados
{
    # trata quantidade
    public function tratarCapacidade($quantidade)
    {
        return str_replace(',', '.',str_replace('.', '', $quantidade));
    }

    # trata porcentagems
    public function tratarPorcentagem($porcentagem)
    {
        return str_replace(',','.',str_replace('%', '', $porcentagem));
    }   

    # trata valor unitario
    public function tratarValorUnitario($valorunitario)
    {
    return str_replace(',', '.',str_replace('.', '', $valorunitario));
    }   

    # trata valor
    public function tratarValorLimite($valor)
    {
    return str_replace(',', '.',str_replace('.', '', $valor));
    }   

    # trata quantidade
    public function tratarQuantidade($quantidade)
    {
    return str_replace(',', '.',str_replace('.', '', $quantidade));
    }   

    # tratar data hora sem segundos
    public function tratarDataHora($data_hora)
    {   
        return preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $data_hora);
    }

    # tratar data
    public function tratarData($data)
    {   
        if(empty($data)){
            return date("Y-m-d");
        } else {
            return date('Y-m-d', strtotime(str_replace('-', '/', $data)));
           
        }
    }
    
}