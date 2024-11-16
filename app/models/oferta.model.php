<?php
require_once './config.php';
require_once 'app/models/model.php';

class OfertaModel extends Model{

    private $model;

    public function __construct() {
        $this->model = new Model();
    }

     //Función que pide a la DB todas las tareas
    /* public function get(){
        $pdo = $this->model->devolverconexion();

        $sql = 'select * from oferta order by descuento DESC';
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $ofertas = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $ofertas;
    }
    */
    public function getAll($descuento = null, $orden = 'ASC') {
        // Obtener la conexión PDO directamente (ajusta según tu implementación)
        $pdo = $this->model->devolverconexion(); 
    
        // Validar el tipo de orden
        $orden = strtoupper($orden) === 'DESC' ? 'DESC' : 'ASC';
    
        // Base de la consulta
        $sql = "SELECT * FROM oferta";
        $valores = [];
    
        // Agregar el filtro opcional por descuento
        if (!empty($descuento)) {
            $sql .= " WHERE descuento <= ?";
            $valores[] = $descuento;
        }
    
        // Agregar la ordenación por el campo 'descuento'
        $sql .= " ORDER BY descuento $orden";
    
        // Preparar la consulta
        $query = $pdo->prepare($sql);
    
        // Ejecutar la consulta con los valores bindados
        $query->execute($valores);
    
        // Obtener y retornar los resultados
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    //Función para crear una nueva oferta
    public function createoferta($id_producto, $nombre, $descuento){
        $pdo = $this->model->devolverconexion();
        
        $sql = 'INSERT INTO oferta (id_producto, nombre, descuento) 
                VALUES (?, ?, ?)';

        $query = $pdo->prepare($sql);
        return $query->execute([$id_producto, $nombre, $descuento]);    
    }

    public function getOfertas($id){
        $pdo = $this->model->devolverconexion();

        $sql = 'SELECT * FROM oferta WHERE id = ?' ;
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        $oferta = $query->fetch(PDO::FETCH_ASSOC);

        return $oferta;
    }


    //Modifica tarea
    public function updateoferta($id_producto, $nombre, $descuento, $id){
        $pdo = $this->model->devolverconexion();

        $sql = 'UPDATE oferta
            SET id_producto = ?, nombre = ?, descuento = ?
            WHERE id = ?';

        $query = $pdo->prepare($sql);
        $oferta = $query->execute([$id_producto, $nombre, $descuento, $id]);
        
        return $oferta;
   }
  
    // Método para obtener la oferta según el ID de la categoría
    public function getOfertasCategoria($id) {
        // Prepara la consulta para buscar la oferta por categoría
        $pdo = $this->model->devolverconexion();

        $sql = 'SELECT o.id, o.nombre, o.descuento, p.nombre AS producto_nombre, p.descripcion, c.nombre 
        AS categoria_nombre FROM oferta o JOIN producto p ON o.id_producto = p.id_producto
        JOIN categoria c ON p.id_categoria = c.id_categoria
        WHERE c.id_categoria = ?';

        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        // Retorna la oferta como un array asociativo
        $oferta = $query->fetch(PDO::FETCH_ASSOC);

        return $oferta;
    }
}

 