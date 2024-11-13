<?php

class ProductModel {

    //Crea la conexión a la DB
    private function crearConexion () {

        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'db_limpieza';
    
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
        } catch (\Throwable $th) {
            die($th);
        }

        return $pdo;
    } 
     //Función que pide a la DB todas las tareas
     public function getProductos(){
        $pdo = $this->crearConexion();

        $sql = "select * from producto order by precio DESC";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $productos;
    }

    //Función para crear una nueva tarea
    public function createProducto($producto, $nombre, $marca, $capacidad, $precio, $descripcion){
        $pDO = $this->crearConexion();
        
        $sql = 'INSERT INTO producto ($producto, $nombre, $marca, $capacidad, $precio, $descripcion) 
                VALUES (?, ?, ?)';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$producto, $nombre, $marca, $capacidad, $precio, $descripcion]);
            return $producto;
        } catch (\Throwable $th) {
            return null;
        }
    }

    //Elimina de la DB la tarea con ese id
    public function deleteProducto($id){
        $pDO = $this->crearConexion();
    
        $sql = 'DELETE FROM tarea
                WHERE id = ?';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$id]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    //Función que trae una tarea por id
    public function getProducto($id){
        $pdo = $this->crearConexion();

        $sql = "SELECT * FROM producto
        WHERE id = ?" ;
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto;
    }


    //Modifica tarea
    public function updateproducto($producto, $nombre, $marca, $capacidad, $precio, $descripcion,$id){
        $pDO = $this->crearConexion();

        $sql = 'UPDATE tarea
            SET descripcion = ?, terminada = ?, prioridad = ?
            WHERE id = ?';

        $query = $pDO->prepare($sql);
        try {
            $query->execute([$producto, $nombre, $marca, $capacidad, $precio, $descripcion,$id]);
            return $id;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
 