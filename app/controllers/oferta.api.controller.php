<?php

require_once 'app/models/oferta.model.php';
require_once 'app/controllers/api.controller.php';

class OfertaApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new OfertaModel();
        $this->view = new apiView();
    }
  
    public function getAll(){
        $ofertas = $this->model->get();
        return $this->view->response($ofertas, 200);
    }

    public function get($req){
        $id = $req->params->id;

        $oferta = $this->model->getOfertas($id);

        if(!$oferta){
            return $this->view->response("No existe la oferta con el id = $id", 404);
        }

        return $this->view->response($oferta, 200);
    }

   

    public function create($req){
        $id_producto = $req->body->producto;
        $nombre = $req->body->nombre;
        $descuento = $req->body->descuento;
     

        if(empty($id_producto) || empty($nombre) || empty($descuento)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $dato = $this->model->createoferta($id_producto, $nombre, $descuento);

        return $this->view->response($dato, 200);

    }

    public function update($req){
        $id = $req->params->id;
        $oferta = $this->model->getOfertas($id);
            if(!$oferta){
            return $this->view->response("No existe oferta con id = $id", 404);
        }

        $id_producto = $req->body->producto;
        $nombre = $req->body->nombre;
        $descuento = $req->body->descuento;
        

        if(empty($id_producto) || empty($nombre) || empty($descuento)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $idEditado = $this->model->updateoferta($id_producto, $nombre, $descuento);

        return $this->view->response($idEditado, 200);
    }
    
  
        public function getcategorias($id) {
            // Obtiene el ID de la categoría desde los parámetros de la URL
        
    
            // Valida que el ID sea un número
            if (empty($id)) {
                // Crea una instancia del modelo de oferta
                $ofertaModel = new OfertaModel();
    
                // Obtiene la oferta para la categoría con el ID proporcionado
                $oferta = $ofertaModel->getOfertaByCategoria($id);
    
                // Si la oferta existe, la devuelve en formato JSON
                if ($oferta) {
                    header("Content-Type: application/json");
                    echo json_encode($oferta);
                } else {
                    // Devuelve un mensaje de error si la oferta no existe
                    header("HTTP/1.1 404 Not Found");
                    echo json_encode(["error" => "No se encontró una oferta para la categoría con ID $id."]);
                }
            } else {
                // Responde con un error si el ID no es válido
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(["error" => "ID de categoría no válido."]);
            }
        }
    }
    