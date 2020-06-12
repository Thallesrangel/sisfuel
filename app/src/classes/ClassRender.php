<?php

namespace Src\classes;

use Src\traits\UrlParser;

class ClassRender 
{   
    use UrlParser;

    private $dir;
    private $title;
    private $description;
    private $keywords;
    private $breadcrumb;

    public function getDir(){ return $this->dir;}
    public function setDir($Dir){$this->dir = $Dir;}

    public function getTitle(){ return $this->title;}
    public function setTitle($Title){$this->title = $Title;}

    public function getDescription(){ return $this->description;}
    public function setDescription($Description){$this->description = $Description;}

    public function getKeywords(){ return $this->keywords;}
    public function setKeywords($Keywords){$this->keywords = $Keywords;}

    public function getBreadCrumb(){ return $this->breadcrumb;}
    public function setBreadCrumb($breadcrumb){$this->breadcrumb = $breadcrumb;}



    public function addBreadCrumb(){
        $pegarBread = $this->getBreadCrumb();

        foreach ($pegarBread as $key => $value) {
    
        echo "<a href=".DIRPAGE."/".$value." > ".$key ."</a>";
        echo " / ";
        }
    }

    # Renderizar todo layout
    public function renderLayout()
    {   
        # Array que não usa o layout padrão (controller)
       $layoutDiferente = [       
            'login',
            'cliente'
       ];

        # Array que não usa o layout padrão (action)
        $actionDiferente = [       
            'externo',
            'registro_externo',
            'recuperar'
        ];
        # Verifica se possui um controlador ou action especificado nos array acima, SE POSSUIR ele vai para o layout sem menu
        if (in_array($this->parserUrl()[0], $layoutDiferente) OR isset($this->parserUrl()[1]) ? in_array( $this->parserUrl()[1], $actionDiferente ) : ''){
            require_once (DIRREQ."/app/view/layout/LayoutPadraoSemMenu.php");
        } else {
            require_once (DIRREQ."/app/view/layout/layout.php");
        }
    }

    # Adiciona caracteristicas especificas no head
    public function addHead()
    { 
        if (file_exists(DIRREQ."/app/view/{$this->getDir()}/head.php")){
            include (DIRREQ."/app/view/{$this->getDir()}/head.php");
        }
    }

    # Adiciona caracteristicas especificas no head
    public function addHeader()
    {
        if (file_exists(DIRREQ."/app/view/{$this->getDir()}/header.php")){
            include (DIRREQ."/app/view/{$this->getDir()}/header.php");
        }
    }

    # Adiciona caracteristicas especificas no main
    public function addMain()
    {  
        if (file_exists(DIRREQ."/app/view/{$this->getDir()}/main.php")){
            include (DIRREQ."/app/view/{$this->getDir()}/main.php");
        }
        
    }

    # Adiciona caracteristicas espeficicas no footer
    public function addFooter()
    {
        if (file_exists(DIRREQ."/app/view/{$this->getDir()}/footer.php")){
            include (DIRREQ."/app/view/{$this->getDir()}/footer.php");
        }
    }
}