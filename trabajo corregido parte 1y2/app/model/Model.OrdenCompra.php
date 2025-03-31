<?php

 
    class ModelOrdenDeCompra{    
        private $db; 
         public function __construct() {
           $this->db =  new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
        }

        public function getItem($id){
        $query = $this->db->prepare('select * from ordendecompra WHERE id = ?');
        $query->execute([$id]);
        $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ventas;
        }
        
        public function getAll(){

            $query = $this->db->prepare('select * from ordendecompra');
            $query->execute();

            $ordenesC = $query->fetchAll(PDO::FETCH_OBJ);
            return $ordenesC;
        }

        function insertOrden($nombre,$apellido,$nombre_producto,$tipoDeProducto,$descripcion,$imagen){
       
        $query = $this->db->prepare('INSERT INTO ordendecompra (nombre,apellido,nombre_producto,tipoProducto,descripcion,imagen) VALUES (?,?,?,?,?,?) ');
        $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeProducto,$descripcion,$imagen]); 

        $id = $this->db->lastInsertId();
        header("Location: listar");
        header("Location: ". "listar");

        
        return $id;
        }
        
        
            function editOrden($data, $id) {
            
                $fields = [];
                $values = [];
            
                if (!empty($data['nombre'])) {
                    $fields[] = 'nombre = ?';
                    $values[] = $data['nombre'];
                }
                if (!empty($data['descripcion'])) {
                    $fields[] = 'descripcion = ?';
                    $values[] = $data['descripcion'];
                }
                if (!empty($data['apellido'])) {
                    $fields[] = 'apellido = ?';
                    $values[] = $data['apellido'];
                }
                if (!empty($data['nombre_producto'])) {
                    $fields[] = 'nombre_producto = ?';
                    $values[] = $data['nombre_producto'];
                }
                if (!empty($data['tipoProducto'])) {
                    $fields[] = 'tipoProducto = ?';
                    $values[] = $data['tipoProducto'];
                }
                
                
             
                 
                $sql = 'UPDATE ordendecompra SET ' . implode(', ', $fields) . ' WHERE id = ?';
                $values[] = $id; 
            
                
                $query = $this->db->prepare($sql);
                $query->execute($values);
            }
            
    

        function deleteOrden($id) {
        
            $query =$this->db->prepare('DELETE FROM ordendecompra WHERE id = ?');
            $query->execute([$id]);
           
        }

       
    }


