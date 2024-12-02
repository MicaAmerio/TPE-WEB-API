<?php
require_once './config.php';
require_once 'app/models/model.php';

class OfertaModel extends Model{

    private $model;

    public function __construct() {
        $this->model = new Model();
    }

     /*public function getAll($filtros = [], $ordenarPor = null, $orden = 'ASC') {
        $pdo = $this->model->devolverconexion(); 
    
        $sql = "SELECT * FROM oferta";
        $valores = [];
    
        //filtros opcionales
        if (!empty($filtros['id_producto'])) {
            $sql .= " AND id_producto = ?";
            $valores[] = $filtros['id_producto'];
        }
        if (!empty($filtros['descuento_min'])) {//trae productos con descuentos hasta el valor pasado por parametro
            $sql .= " AND descuento <= ?";
            $valores[] = $filtros['descuento_min'];
        }
        if (!empty($filtros['nombre'])) {
            $sql .= " AND nombre = ?";
            $valores[] = $filtros['nombre'];
        }
       
        // Si existe $ordenarPor 
        if ($ordenarPor) {
                $sql .= " ORDER BY $ordenarPor $orden";
        }
    
        $query = $pdo->prepare($sql);
        $query->execute($valores);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }*/
    public function getAllDesc() {
        $pdo = $this->model->devolverconexion();

        $sql = 'SELECT * FROM oferta ORDER BY oferta.id DESC'; //se estan ordenando por la columna id ascendentemente
        $query = $pdo->prepare($sql);
        $query->execute();

        $ofertas = $query->fetchAll(PDO::FETCH_ASSOC);

        return $ofertas;
    }
    public function getAllByColumByOrder($columna, $orden){
        $pdo = $this->model->devolverconexion();

        $sql = 'SELECT * FROM oferta ORDER BY oferta.' . $columna . ' ' . $orden; //se estan ordenando por la columna id ascendentemente
        $query = $pdo->prepare($sql);
        $query->execute();

        $ofertas = $query->fetchAll(PDO::FETCH_ASSOC);

        return $ofertas;
    }
     
    


    public function getAll() {
        $pdo = $this->model->devolverconexion();

        $sql = 'SELECT * FROM oferta ORDER BY oferta.id ASC'; 
        $query = $pdo->prepare($sql);
        $query->execute();

        $ofertas = $query->fetchAll(PDO::FETCH_ASSOC);

        return $ofertas;
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

 