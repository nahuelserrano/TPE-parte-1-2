<?php

class ViewTipoProductos { 
    
    private $res;

    public function __construct($res) {
        $this->res = $res;
    }
       public function ShowOrdenesFiltradas($ordenes){
    
        require_once 'templates/layout/header.phtml';
       if($this->res->user){ require_once 'templates/InsertarOrden.phtml';}
        require_once'templates/ListaOrdenes.phtml';
   
        if($this->res->user){   require_once'templates/BotonLogOUt.phtml';}
    }

    
    public function ShowTiposDeProductos($TipoProductos){
        require_once 'templates/layout/header.phtml';
        require_once'templates/TipoProductos.phtml';
       
        if($this->res->user){   require_once'templates/BotonLogOUt.phtml';}
     
    }
 
  
    public function ShowformEdit($TipoProducto){
        require_once 'templates/layout/header.phtml';
        require_once'templates/FormEditTipoproducto.phtml';   
 
     
        
    }



    public function showError($error) {
        require 'Templates/error.phtml';
    }

}
