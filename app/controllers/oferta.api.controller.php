<?php

require_once 'app/models/oferta.model.php';
require_once 'app/controllers/api.controller.php';

   class OfertaApiController extends ApiController{

    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new OfertaModel();
    }
     /* public function getAll() {
        //Esta función se encarga de obtener una lista de productos
      // Obtener filtros y parámetros de ordenamiento desde la URL
         $filtros = [
             'id_producto' => $_GET['id_producto'] ?? null,
             'descuento_min' => $_GET['descuento_min'] ?? null,
             'nombre' => $_GET['nombre'] ?? null,
         ];
 
         $ordenarPor = $_GET['campo'] ?? null; // Ejemplo: ?campo=descuento
         $orden = strtoupper($_GET['orden'] ?? 'ASC'); // Ejemplo: ?orden=DESC
 
         // solo permitir ASC o DESC
         if ($orden !== 'ASC' && $orden !== 'DESC') {
             $this->view->response("Orden no válido. Solo se permite 'ASC' o 'DESC'.", 400);
             return;
         }
 
         $ofertas = $this->model->getAll($filtros, $ordenarPor, $orden);
         $this->view->response($ofertas, 200);
      //En resumen, esta función permite filtrar y ordenar productos según lo que el usuario especifique en la URL, y responder con los resultados.
     }*/
    public  function getAll() {
        $modelo = new OfertaModel();
        $ofertas = $modelo->getAll();
        if($ofertas){
            return $this->view->response($ofertas, 200);   
        }else{
            return $this->view->response("No existe las ofertas", 400);
        }
    }

    public  function getAllDesc() {
        $modelo = new OfertaModel();
        $ofertas = $modelo->getAllDesc();
        if($ofertas){
            return $this->view->response($ofertas, 200);   
        }else{
            return $this->view->response("No existe las ofertas", 400);
        }
    }
     public function getAllByColumByOrder($req){
        $orden = $req->params->orden; //:orden
        $columna = $req->params->columna; //:columna
        $modelo = new OfertaModel();


        if($orden == "desc"){
            $ofertas = $modelo->getAllByColumByOrder($columna, $orden);
        }
        else if($orden == "asc"){
            $ofertas = $modelo->getAllByColumByOrder($columna, $orden);
        }
        else{
            return $this->view->response("No existe las ofertas", 400);
        }

        if($ofertas){
            return $this->view->response($ofertas, 200);   
        }else{
            return $this->view->response("No existe las ofertas", 400);
        }
    }
     
    
    
        
         public function get($req){ // Esta función se utiliza para obtener una oferta específica según su identificador ( id)
        $id = $req->params->id;
        $oferta = $this->model->getOfertas($id);

        if($oferta){
            return $this->view->response($oferta, 200);   
        }else{
            return $this->view->response("No existe la oferta con el id = $id", 400);
        }
    } 
         public function create(){ //crea una nueva oferta
        $data = $this->getData();

        if(isset($data->id_producto, $data->nombre, $data->descuento)){
            $dato = $this->model->createoferta($data->id_producto, $data->nombre, $data->descuento);
            
            if($dato){
                return $this->view->response(["Oferta creada con exito", $dato], 201);
            }else{
                return $this->view->response("No se pudo crear la oferta", 500);
            }
        }else{
            return $this->view->response("Datos Incompletos", 400);
        }
      }
        public function updateOferta($req){
            $id = $req->params->id;
    
            $oferta = $this->model->getOfertas($id);
    
            if(!$oferta){
                return $this->view->response("No existe oferta con id = $id", 404);
            }
             
            $id_producto = $req->body->id_producto;
            $nombre = $req->body->nombre;
             $descuento = $req->body->descuento;
           
            if(empty($id_producto) || empty($nombre) || empty($descuento)){
                return $this->view->response("Faltan completar campos", 401);
            }
    
            $idEditado = $this->model->updateOferta($id_producto, $nombre, $descuento, $id);
    
            return $this->view->response($idEditado, 200);
        } //En resumen, esta función permite actualizar una oferta existente, asegurándose de que la oferta existe y que todos los campos necesarios estén completos antes de realizar la actualización.
          public function getOfertasByCategoria($req) {
            $id = $req->params->id;

            $ofertas = $this->model->getOfertasCategoria($id);

            if($ofertas){
                return $this->view->response($ofertas, 200);
            }else{
                return $this->view->response("Ofertas no encontradas para la categoria especificada", 400);
            }
           
        }
    }
    