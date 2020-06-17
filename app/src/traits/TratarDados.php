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

}