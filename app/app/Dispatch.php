<?php

# Dispatch - despachante arquivo que instancia
namespace App;

use Src\classes\ClassRoutes;

class Dispatch extends ClassRoutes
{       
    # Atributos
    private $method;
    private $param = [];
    private $obj;


    protected function getMethod() { return $this->method; }
    public function setMethod($Method) {$this->method = $Method; }

    protected function getParam() { return $this->param; }
    public function setParam($Param) {$this->param = $Param; }

    # Metodo consturtor
    public function __construct()
    {
        self::addController();
    }

    # Metodo adicao de controller
    private function addController()
    {
        $rotaController = $this->getRota();
        $namespac = "App\\controller\\{$rotaController}";
        
        $this->obj = new $namespac;
        
        if (isset($this->parserUrl()[1])) {
          self::addMethod();
        }
    }

    # Metodo de adicao de metodo do controller
    private function addMethod()
    {   
        if (method_exists($this->obj, $this->parserUrl()[1]) ) {
          
            $this->setMethod("{$this->parserUrl()[1]}"); 

            self::addParam();
          
            call_user_func_array([$this->obj,$this->getMethod()],$this->getParam());

        }
    }
    # Metodo de adicao de parametros do controller se necessario
    private function addParam()
    {   // Conta a quantidade de elementos de um array
        $contArray = count($this->parserUrl());

        if ($contArray > 2) {
            foreach ($this->parserUrl() as $key => $value) {
                if ($key >1) {
                    $this->setParam($this->param += [$key => $value]);
                }
            }
        }

    }
}