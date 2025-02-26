<?php
require_once 'app/controller/task.php';
require_once 'app/Visual/Task.view.php';

require_once 'libs/Response.phtml';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controller/AuthController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res=new Response();


if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'login';
}


$params = explode('/', $action);


switch ($params[0]) {
    
    case 'addCategoria': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);

        $controller = new controller($res); 
        $controller->addCategoria();
        break;
    case 'editarCategoria':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
            $controller = new controller($res);
            $controller->editarCategoria();
            break;
    case 'eliminarCategoria': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
            $controller = new controller($res); 
            $controller->  eliminarCategoria();
    break;              
    case 'listar': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new controller($res); 
        $controller->showTaskOf();
        break;
    
    case 'home': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new controller($res); 
        $controller->showtask();
        break;
    
    case 'edit': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new controller($res); 
        $controller->  edittask($params[1]);
        break;
        
    case 'insert': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
            $controller = new controller($res); 
            $controller->  addtask();
            break;
    
    case 'delete': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new controller($res); 
        $controller->deleteTask($params[1]);
        break;  
            
        
       
    case 'mostrarMas': 
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
            $controller = new controller($res); 
            $controller-> showItem($params[1]);
            break;  
    case 'showLogin':
                $controller = new AuthController();
                $controller->showLogin();
                break;
    case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
    case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;
                
     
                    
                
                    
   
    default: 
        echo('404 Page not found'); //llamar a la funcior erro de la clase view
        break;
}





?>
