<?php

class TaskView { 
    
    public function showForm($task){
       $count = count($task);
        require_once 'templates/form.phtml';
    }
    public function ShowTaskOf($task){
        $count = count($task);
        require_once'templates/ListaCompradores.phtml';
        require_once'templates/BotonLogOt.phtml';
    }
    public function ShowTask($task){
        
        $count = count($task);
        require_once'templates/ListaCompradores.phtml';
        require_once'templates/BotonLogOt.phtml';
  
    }
    public function ShowItem($item, $categoria, $taskCategorias){
      
        require_once'templates/SingularItem.phtml';
        $count = count($item);
        $count = count($taskCategorias);
         $view = new SingularItem();
         $view-> showItem( $item, $categoria, $taskCategorias );
      
      
    }
    public function ShowCategorias($task){
        require_once'templates/Categories.phtml';
         $count = count($task);
         $view = new Categories();
         $view-> showCategorias( $task );
     
    }
 
    public function ShowFormAddCategoria($task){
        require_once'templates/formCategoria.phtml';   
        $count = count($task);
        $view = new formCategories();
        $view-> showForms($task);
        
    }
    public function showError($error) {
        require 'Templates/error.phtml';
    }

}
