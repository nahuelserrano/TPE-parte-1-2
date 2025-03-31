<?php
require_once "app/visual/View.TipoProducto.php";
require_once "app/visual/viewFunciones.php";

require_once 'app/model/model.TipoProducto.php';

require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
class controllerTipoProducto{
    private $viewError;
    private $view;
    private $model;

   public function __construct($res) {
      $this->model = new ModelTipoProducto();
      $this->view = new ViewTipoProductos($res);
      $this->viewError = new ViewError();
        
    }
    
     
    public function showTiposProductos(){
        $tipoDeProducto = $this->model->getTipoProductos();
        return $this->view-> ShowTiposDeProductos($tipoDeProducto);
     }
    
    
    
    function showPorTipoProducto($id_Tproducto){  
        $ordenes = $this->model->ProductosByTipoProducto($id_Tproducto);
      
        foreach($ordenes as $oo){
        $categoria = $this->model->getById($oo->TipoProducto);
        $oo->categoriaP = $categoria->TipoProducto;
        }

       return $this->view-> ShowOrdenesFiltradas($ordenes);   
    }

    
    function addTipoProducto(){
        if (!isset($_POST['TipoProducto']) || empty($_POST['TipoProducto'])) {
            return $this->viewError->showError('Falta completar el título de la categoria');
        }
        $TipoProducto = $_POST['TipoProducto'];
        $this->model-> insertTipoProducto( $TipoProducto );
        header("Location: " . BASE_URL . "showTiposProductos");
        
    }
    function showFormEdit($id_tipoP){
     
        $tipoDeProducto = $this->model->getById( $id_tipoP ); 
        $this->view->ShowformEdit($tipoDeProducto);
        
    }

    function editarTipoProducto($id){
       
       var_dump($id);
        if (!isset($id)) {
            return $this->viewError->showError('Falta completar el id del tipo de producto que se quiere editar');
        }
        if (!isset($_POST['TipoProductoEditado']) || empty($_POST['TipoProductoEditado'])) {
            return $this->viewError->showError('Falta completar el título del tipo de producto ');
        }
            var_dump($id);

        $nuevoTipoProducto = $_POST['TipoProductoEditado'];
        $this->model-> editTipoProducto( $nuevoTipoProducto,$id );
        header("Location: ". BASE_URL ."showFormEditTipoProductos/$id");
    
    }
    function eliminarTipoProducto($id){
        if (!isset($id)) {
            return $this->viewError->showError('Falta completar el id del Tipo Producto que se quiere eliminar');
        }
        
      
        
        $this->model-> deleteCategoria($id );
        header("Location: ". BASE_URL ."showTiposProductos");
    
    }
    
   


}