<?php
require_once 'app/model/user.model.php';
require_once 'app/Visual/auth.view.php';
require_once 'libs/Response.phtml';


class AuthController {

    private $model;
    private $view;
 
    
    function __construct(){
        $this->model = new UserModelo();
        $this->view = new AuthView();
        
    }
    
        
    function showLogin(){

        return $this->view->showLogin();
    }

    public function login() {
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin("falta completar email");
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin("falta completar contraseña");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Verificar que el usuario está en la base de datos
        $userFromDB = $this->model->getUserByEmail($email);

        if($userFromDB && password_verify($password, $userFromDB->password)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['LAST_ACTIVITY'] = time();

            header("Location: ". BASE_URL ."home");
        } else{
            return $this->view->showLogin("credenciales incorrectas");
            
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}