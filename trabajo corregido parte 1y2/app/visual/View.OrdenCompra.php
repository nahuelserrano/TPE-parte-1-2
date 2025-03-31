<?php

class ViewOrdenDeCompra { 
    private $res;

    public function __construct($res) {
        $this->res = $res;
    }

    
    
    public function ShowOrdenes($ordenes,$categorias){
        require_once 'templates/layout/header.phtml';
       if($this->res->user){ require_once 'templates/InsertarOrden.phtml';}
        require_once'templates/ListaOrdenes.phtml';
   
        if($this->res->user){   require_once'templates/BotonLogOUt.phtml';}
  
    }
    public function ShowItemByid($item, $TipoProducto){
        require_once 'templates/layout/header.phtml';
        require_once 'templates/SingularItem.phtml';
    
      
    }
    
 
    
    
   

}
