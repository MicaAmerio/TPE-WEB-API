<?php

require_once 'app/models/oferta.model.php';
require_once 'app/controllers/api.controller.php';

   class OfertaApiController extends ApiController{

    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new OfertaModel();
    }
  
   /* public function getAll(){
        $ofertas = $this->model->get();
        
        if($ofertas){
             return $this->view->response($ofertas, 200);
        }else{
            return $this->view->response("No se encontraron ofertas", 400);
        */
        public function getAll() {
            // Obtener filtros y parámetros de ordenamiento desde la URL
            $descuento = $_GET['descuento'] ?? null;
            $orden = strtoupper($_GET['orden'] ?? 'ASC'); // Ejemplo: ?orden=DESC
        
            // Validar el orden (solo permitir ASC o DESC)
            if ($orden !== 'ASC' && $orden !== 'DESC') {
                $this->view->response("Orden no válido. Solo se permite 'ASC' o 'DESC'.", 400);
                return;
            }
        
            // Llamar al modelo con los parámetros
            $ofertas = $this->model->getAll($descuento, $orden);
            $this->view->response($ofertas, 200);
        }
        
    

    public function get($req){
        $id = $req->params->id;
        $oferta = $this->model->getOfertas($id);

        if($oferta){
            return $this->view->response($oferta, 200);   
        }else{
            return $this->view->response("No existe la oferta con el id = $id", 400);
        }
    } 
         public function create(){
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
            $this->view->response("No existe oferta con ese id");
        }
        else{
            $id_producto = $req->body->id_producto;
            $nombre = $req->body->nombre;
            $descuento = $req->body->descuento;

            if(isset($id_producto, $nombre, $descuento)){
                $ofertaActualizada = $this->model->updateoferta($id_producto, $nombre, $descuento, $id );
    
                if($ofertaActualizada){
                    return $this->view->response(["Oferta actualizada con exito", $ofertaActualizada], 200);
                }else{
                    return $this->view->response("Oferta no encontrada", 400);
                }
            }else{
                return $this->view->response("Datos Incompletos", 400);
            }
    
        }



        
    }
    
  
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
    