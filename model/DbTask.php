<?php

 function getconect(){
    return new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
}    

    class taskModel{    
        
        public function getAllOf($categoria){
            
        $db = getconect();

        $query = $db->prepare('select * from comprador where tipo_de_compra = ?');
        $query->execute([$categoria]);
    
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);  
        
    
        return $ventas;
        }
        public function getCategorias(){
      
               
            $db = getconect();
        
            $query = $db->prepare('select * from categoria');
            $query->execute();
        
            
            $categorias = $query->fetchAll(PDO::FETCH_OBJ);      
           
        
            return $categorias;
            }
        public function getItem($id){
           
        $db = getconect();
    
       
        $query = $db->prepare('select * from comprador WHERE id = ?');
        $query->execute([$id]);
    
        
        $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
    

    
        return $ventas;
        }
        
   public function getAll(){
        
    $db = getconect();

    $query = $db->prepare('select * from comprador');
    $query->execute();

    $ventas = $query->fetchAll(PDO::FETCH_OBJ);
    return $ventas;
    }

    function insertTask($nombre,$apellido,$nombre_producto,$tipoDeCompra){
        $db = getconect();
        var_dump($tipoDeCompra);
        $query = $db->prepare('INSERT INTO comprador (nombre,apellido,nombre_producto,tipo_de_compra) VALUES (?,?,?,?) ');
        $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra]); 

        $id = $db->lastInsertId();
        header("Location: listar");
        header("Location: ". "listar");

        
        return $id;
        }
        function insertCategoria($categoria){
            $db = getconect();
            
            $query = $db->prepare('INSERT INTO categoria(nombre_categoria) VALUES (?) ');
            $query -> execute([$categoria]); 
    
            $id = $db->lastInsertId();
            header("Location: listar");
            header("Location: ". "listar");
    
            return $id;
        
            }
         function editCategoria($nombre_categoria, $idcate){
            $db = getconect();
            $query = $db->prepare('SELECT COUNT(*) FROM categoria WHERE nombre_categoria = ? AND id != ?');
            $query->execute([$nombre_categoria, $idcate]);
            $count = $query->fetchColumn();

            if ($count > 0) {
                throw new Exception("Ya existe una categoría con el nombre '{$nombre_categoria}'");
            }

            
            $query = $db->prepare('UPDATE categoria SET nombre_categoria = ? WHERE id = ?');
            $query->execute([$nombre_categoria, $idcate]);   
            
        }
        function deleteCategoria($id) {
            $db = getconect();
            $query =$db->prepare('DELETE FROM categoria WHERE id = ?');
            $query->execute([$id]);
           
        }

        function editTask2($nombre,$apellido,$nombre_producto,$tipoDeCompra, $id){
            $db = getconect();
            
            $query =$db->prepare('UPDATE comprador SET nombre = ? SET apellido=? SET nombre_producto=? SET tipo_de_compra =? WHERE id = ?');            
            $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra,$id]); 
            }


            function editTask($data, $id) {
                $db = getconect();
                
                $fields = [];
                $values = [];
            
                if (!empty($data['nombre'])) {
                    $fields[] = 'nombre = ?';
                    $values[] = $data['nombre'];
                }
                if (!empty($data['apellido'])) {
                    $fields[] = 'apellido = ?';
                    $values[] = $data['apellido'];
                }
                if (!empty($data['nombre_producto'])) {
                    $fields[] = 'nombre_producto = ?';
                    $values[] = $data['nombre_producto'];
                }
                if (!empty($data['tipo_de_compra'])) {
                    $fields[] = 'tipo_de_compra = ?';
                    $values[] = $data['tipo_de_compra'];
                }
                
                
                var_dump($data['tipo_de_compra']);
                 
                $sql = 'UPDATE comprador SET ' . implode(', ', $fields) . ' WHERE id = ?';
                $values[] = $id; 
            
                
                $query = $db->prepare($sql);
                $query->execute($values);
            }
            
    

        function deleteTask($id) {
            $db = getconect();
            $query =$db->prepare('DELETE FROM comprador WHERE id = ?');
            $query->execute([$id]);
           
        }

        function getCategoriaItem($id) {
            $db = getconect();
            $query =$db->prepare('SELECT nombre_categoria FROM categoria WHERE id = ?');
            $query->execute([$id]);
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }
    }


