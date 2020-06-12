<?php

namespace Src\Traits;

    # Classe auxiliar
trait UrlParser
{
    # Dividir URL em um array
    public function parserUrl()
    {
        return explode("/", rtrim($_GET['url']), FILTER_SANITIZE_URL);
    }
}