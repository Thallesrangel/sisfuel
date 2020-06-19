<?php
# PASTA ONDE ESTA O DIRETORIO DO PROJETO
$pastaInterna = "sisfuel";
# CAMINHO ABOSLUTO
define ("DIRPAGE","http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}/app");
define ("DIRRAIZ", "http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");

# CAMINHO FISICO DO SERVIDOR (REQUERIR ARQUIVO)
# verifica se a ultima letra do servidor é uma barra  - se for ele não coloca e se não tiver ele coloca no else
# isso ocorre pq alguns servidores colocam e outros não a barra no fim da url
if (substr($_SERVER['DOCUMENT_ROOT'],-1) == '/') {
    define ("DIRREQ","{$_SERVER['DOCUMENT_ROOT']}{$pastaInterna}/app");
} else {
    define ("DIRREQ","{$_SERVER['DOCUMENT_ROOT']}/{$pastaInterna}/app");
}


# Diretorios especificos

define ("DIRIMG", DIRPAGE."/public/img/");
define ("DIRCSS", DIRPAGE."/app/css/");
define ("DIRJS",  DIRPAGE."/app/js/");
define ("NODE_MODULES",  DIRRAIZ."/node_modules/");


define('HOST', '127.0.0.1');
define('USER', 'root');
define('DBNAME','sisfuel');
define('PASS', '');