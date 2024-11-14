<?php
require_once './config.php';
class OfertaModel {

    //Crea la conexión a la DB
    private function crearConexion () {
    
        try {
            $pdo = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        } catch (\Throwable $th) {
            die($th);
        }

        return $pdo;
    } 
     //Función que pide a la DB todas las tareas
     public function get(){
        $pdo = $this->crearConexion();

        $sql = "select * from oferta order by descuento DESC";
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $ofertas = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $ofertas;
    }

    //Función para crear una nueva tarea
    public function createoferta($id_producto, $nombre, $descuento){
        $pDO = $this->crearConexion();
        
        $sql = 'INSERT INTO oferta ($id_producto, $nombre, $descuento)) 
                VALUES (?, ?, ?)';

        $query = $pDO->prepare($sql);
        
           $query->execute([$id_producto, $nombre, $descuento]);
            
        
    }

    public function getOfertas($id){
        $pdo = $this->crearConexion();

        $sql = "SELECT * FROM oferta
        WHERE id = ?" ;
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        $ofertas = $query->fetch(PDO::FETCH_OBJ);

        return $ofertas;
    }


    //Modifica tarea
    public function updateoferta($id_producto, $nombre, $descuento){
        $pDO = $this->crearConexion();

        $sql = 'UPDATE oferta
            SET id_producto = ?, nombre = ?, descuento = ?
            WHERE id = ?';

        $query = $pDO->prepare($sql);
       
            $query->execute([$id_producto, $nombre, $descuento]);
            
   }
  
    private $db;

    public function __construct() {
        // Configura la conexión a la base de datos (ajusta los parámetros si es necesario)
        $this->db = new PDO('mysql:host=localhost;dbname=db-limpieza;charset=utf8', 'root', '');
    }

    // Método para obtener la oferta según el ID de la categoría
    public function getOfertaByCategoria($id) {
        // Prepara la consulta para buscar la oferta por categoría
        $query = $this->db->prepare("SELECT * FROM ofertas WHERE categoria_id = ?");
        $query->execute([$id]);

        // Retorna la oferta como un array asociativo
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

 