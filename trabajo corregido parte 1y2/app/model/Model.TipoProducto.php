<?php

 
    class ModelTipoProducto{   
        private $db; 
         public function __construct() {
           $this->db =  new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
        }
        
        public function ProductosByTipoProducto($idTipoProducto){
            
      
        $query = $this->db ->prepare('select * from ordendecompra where tipoProducto = ?');
        $query->execute([$idTipoProducto]);
    
        $ordenesCompra = $query->fetchAll(PDO::FETCH_OBJ);  
        
    
        return $ordenesCompra;
        }
        public function getTipoProductos(){
           
        
            $query =$this->db->prepare('select * from categoria');
            $query->execute();
    
            $tipoProductos = $query->fetchAll(PDO::FETCH_ASSOC);      
            return $tipoProductos;
            }
        
        
   
    
        function insertTipoProducto($tipoDeProducto){
            
            $query = $this->db ->prepare('INSERT INTO categoria(tipoProducto) VALUES (?) ');
            $query -> execute([$tipoDeProducto]); 
    
            $id = $this->db ->lastInsertId();
      
           
            
            return $id;
            
        
            }
         function editTipoProducto($TipoProducto, $id){

            $sql = 'UPDATE categoria SET TipoProducto=? WHERE id = ?';
            $query = $this->db->prepare($sql);
           
            $query->execute( [$TipoProducto,$id]);
            }        
        function deleteCategoria($id) {
            try {
                $query =$this->db->prepare("DELETE FROM categoria WHERE id = ?");
                $query->execute([$id]);
            } catch (PDOException $e) {
                echo "No puedes eliminar esta categoría porque hay compradores asociados.";
            }
            
        }


        function getById($id) {
           
            $query =$this->db->prepare('SELECT*FROM categoria WHERE id = ?');
            $query->execute([$id]);
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        function getBynombre($nombre) {
           
            $query =$this->db->prepare('SELECT*FROM categoria WHERE TipoProducto = ?');
            $query->execute([$nombre]);
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }
        
    }


