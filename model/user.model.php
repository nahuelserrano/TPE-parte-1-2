<?php
require_once "app/model/config.php";
class UserModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
        $this->deploy();
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END

		END;
            $this->db->query($sql);
            }
        }

    public function getUserByEmail($email){

        $query = $this->db->prepare('SELECT * FROM usuario WHERE gmail = ?');
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        
        return $user;
    }

}