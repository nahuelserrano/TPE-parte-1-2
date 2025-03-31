<?php
require_once 'app/controller/Controller.OrdenCompral.php';
require_once 'app/controller/Controller.TipoProducto.php';
require_once 'app/controller/AuthController.php';

require_once 'app/visual/View.OrdenCompra.php';
require_once 'app/visual/View.OrdenCompra.php';

require_once 'libs/Response.phtml';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res=new Response();


if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'login';
}


$params = explode('/', $action);


switch ($params[0]) {
   
    
    case 'home': 
        sessionAuthMiddleware($res);
        $controllerOrdenes = new controllerOrdenes($res); 
        $controllerOrdenes->showOrdenesDeCompra();
        break;


    
    case 'editOrden': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerOrdenes = new controllerOrdenes($res); 
        $controllerOrdenes->  editOrdenCompra($params[1]);
        break;
        
    case 'addOrdenCompra': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
            $controllerOrdenes = new controllerOrdenes($res); 
            $controllerOrdenes->  addOrdenCompra();
            break;
    
    case 'deleteOrden': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerOrdenes = new controllerOrdenes($res); 
        $controllerOrdenes->deleteOrdenCompra($params[1]);
        break;  


        case 'mostrarMas': 
            sessionAuthMiddleware($res);
   
                $controllerOrdenes = new controllerOrdenes($res); 
                $controllerOrdenes-> showItem($params[1]);
                break;  
    






          case 'showTiposProductos': 
            sessionAuthMiddleware($res);
           
            
            $controllerTipoProducto = new controllerTipoProducto($res); 
            $controllerTipoProducto->showTiposProductos();
            break;


 
        case 'addTipoProducto': 
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
    
            $controllerTipoProducto = new controllerTipoProducto($res); 
            $controllerTipoProducto->addTipoProducto();
            break;
        case 'editartipoProducto':
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
                $controllerTipoProducto = new controllerTipoProducto($res);
                $controllerTipoProducto->editarTipoProducto($params[1]);
                break;
        case 'deleteTipoProductos': 
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
                $controllerTipoProducto = new controllerTipoProducto($res); 
                $controllerTipoProducto->  eliminarTipoProducto($params[1]);
        break;              
        
        
        case 'listar': 
            sessionAuthMiddleware($res);
      
            $controllerTipoProducto = new controllerTipoProducto($res); 
            $controllerTipoProducto->showPorTipoProducto($params[1]);
            break;

        case 'showFormEditTipoProductos': 
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $controllerTipoProducto = new controllerTipoProducto($res); 
            $controllerTipoProducto->showFormEdit($params[1]);
            break;
            
            
   


    case 'showLogin':
                $AuthController = new AuthController();
                $AuthController->showLogin();
                break;
    case 'login':
                $AuthController = new AuthController();
                $AuthController->login();
                break;
    case 'logout':
                $AuthController = new AuthController();
                $AuthController->logout();
                break;
                
     
                    
                
                    
   
    default: 
        echo('404 Page not found'); //llamar a la funcior erro de la clase view
        break;
}





?>
