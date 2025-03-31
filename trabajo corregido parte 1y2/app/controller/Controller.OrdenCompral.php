<?php
require_once "app/visual/viewFunciones.php";
require_once "app/visual/View.OrdenCompra.php";

require_once "app/model/Model.OrdenCompra.php";
require_once 'app/model/model.TipoProducto.php';

require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
class controllerOrdenes{
   
    private $viewOrden;
    private $viewError;
    private $ModelOrdenDeCompra;
    private $modelTipoProducto;


   public function __construct($res) {
      $this->ModelOrdenDeCompra = new ModelOrdenDeCompra();
      $this->viewOrden = new ViewOrdenDeCompra($res);
      $this->viewError = new ViewError();
      $this->modelTipoProducto = new ModelTipoProducto();
      
    }
    
        function showOrdenesDeCompra(){
        $ordenes =$this->ModelOrdenDeCompra-> getAll();
        foreach($ordenes as $oo){
        $categoria = $this->modelTipoProducto->getById($oo->TipoProducto);
        $oo->categoriaP = $categoria->TipoProducto;
        }
        $categorias=$this->modelTipoProducto->getTipoProductos();

        return $this->viewOrden-> ShowOrdenes($ordenes,$categorias);   
    }


   
    function addOrdenCompra(){
        
        var_dump($_POST['tipoDeProducto']);
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->viewError->showError('Falta completar el nombre');
        }
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->viewError->showError('Falta completar el apellido');
        }
        if (!isset($_POST['nombre_producto']) || empty($_POST['nombre_producto'])) {
            return $this->viewError->showError('Falta completar el nombre del producto');
        }
       
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->viewError->showError('Falta completar descripcion');
        }
        if (!isset($_POST['tipoDeProducto']) || empty($_POST['tipoDeProducto'])) {
            return $this->viewError->showError('Falta completar tipo De Producto');
        }
        //en este paso proceso la imagen
        $imagen = null;
    if (isset($_FILES['input_name']) && $_FILES['input_name']['error'] == 0) {
        $fileTemp = $_FILES['input_name']['tmp_name'];
        $fileName = uniqid() . '_' . basename($_FILES['input_name']['name']);
        $filePath = 'imagenes/' . $fileName;
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowedExts)) {
            if (move_uploaded_file($fileTemp, $filePath)) {
                $imagen = $filePath;
            }
        } else {
            return $this->viewError->showError("Formato de imagen no permitido o tamaño demasiado grande.");
        }
    }
     
       

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombre_producto = $_POST['nombre_producto'];
        $tipoDeProducto = $_POST['tipoDeProducto'];
        $descripcion = $_POST['descripcion'];


       
        
        $this->ModelOrdenDeCompra-> insertOrden($nombre,$apellido,$nombre_producto, $tipoDeProducto,$descripcion,$imagen);
        header('Location: ' . BASE_URL . 'home');
    }
    
    
    function deleteOrdenCompra($id){
        $item = $this->ModelOrdenDeCompra->getItem($id);
        if (!$item) {
            return $this->viewError->showError('No existe esa factura');
        }
         $this->ModelOrdenDeCompra->deleteOrden($id) ;
         header("Location: ". BASE_URL ."home");
    }


    

    function editOrdenCompra($id) {
        $item = $this->ModelOrdenDeCompra->getItem($id);
        if (!$item) {
            return $this->viewError->showError('No existe esa factura');
        }
    
       
        $data = [];
    
        if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
            $data['descripcion'] = $_POST['descripcion'];
        }
        if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
            $data['nombre'] = $_POST['nombre'];
        }
        if (isset($_POST['apellido']) && !empty($_POST['apellido'])) {
            $data['apellido'] = $_POST['apellido'];
        }
        if (isset($_POST['nombre_producto']) && !empty($_POST['nombre_producto'])) {
            $data['nombre_producto'] = $_POST['nombre_producto'];
        }
        if (isset($_POST['tipoProducto']) && !empty($_POST['tipoProducto'])) {
            $categoriaPermitida= $this->modelTipoProducto -> getBynombre($_POST['tipoProducto']);
            if($categoriaPermitida){
                $idCategoria = $categoriaPermitida->id;
                $data['tipoProducto'] = $idCategoria;
        }else{
            return $this->viewError->showError('tipo de producto inexistente');
        }
        }
    
      
        if (empty($data)) {
            return $this->viewError->showError('Debe completar al menos un campo para actualizar');
        }
    
        $this->ModelOrdenDeCompra->editOrden($data, $id);
    
        
        header("Location: " . BASE_URL . "mostrarMas/$id");
    }
    
    function showItem($id){
       
        if (!isset($id) || empty($id)) {
         return $this->viewError->showError('Falta completar el id');
     }
        $item = $this->ModelOrdenDeCompra->getItem($id);
        $itemS = $item[0];
        $cat = $this->modelTipoProducto->getById($itemS["TipoProducto"]);
       
        
       
        if (!$item) {
         return $this->viewError->showError('no existe esa factura');
     }
   
         return $this->viewOrden-> ShowItemByid($item, $cat);
         
     }
    
    
   


}