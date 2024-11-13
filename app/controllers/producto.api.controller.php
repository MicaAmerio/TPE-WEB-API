<?php

require_once 'app/models/product.model.php';
require_once 'app/views/api.view.php';

class ProductoApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new apiView();
    }
  
    public function getAll(){
        $productos = $this->model->getProductos();

        return $this->view->response($productos, 200);
    }

    public function get($req){
        $id = $req->params->id;

        $producto = $this->model->getProducto($id);

        if(!$producto){
            return $this->view->response("No existe el producto con el id = $id", 404);
        }

        return $this->view->response($producto, 200);
    }

    public function delete($req){
        $id = $req->params->id;

        $producto = $this->model->getProducto($id);

        if(!$producto){
            return $this->view->response("No existe el producto con el id = $id", 404);
        }
        else{
            $this->model->deleteProducto($id);
            return $this->view->response("Se a eliminado el producto con id = $id", 200);
        }
    }

    public function create($req){
        $producto = $req->body->producto;
        $nombre = $req->body->nombre;
        $marca = $req->body->marca;
        $capacidad = $req->body->capacidad;
        $precio = $req->body->precio;
        $descripcion = $req->body->descripcion;

        if(empty($producto) || empty($nombre) || empty($marca)|| empty($capacidad)  || empty($precio) || empty($descripcion)           ){
            return $this->view->response("Faltan completar campos", 401);
        }

        $dato = $this->model->createProducto($producto, $nombre, $marca, $capacidad, $precio, $descripcion);

        return $this->view->response($dato, 200);

    }

    public function update($req){
        $id = $req->params->id;

        $producto = $this->model->getProducto($id);

        if(!$producto){
            return $this->view->response("No existe producto con id = $id", 404);
        }

        $producto = $req->body->producto;
        $nombre = $req->body->nombre;
        $marca = $req->body->marca;
        $capacidad = $req->body->capacidad;
        $precio = $req->body->precio;
        $descripcion = $req->body->descripcion;

        if(empty($producto) || empty($nombre) || empty($marca)|| empty($capacidad)  || empty($precio) || empty($descripcion)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $idEditado = $this->model->updateProducto($producto, $nombre, $marca, $capacidad, $precio, $descripcion,$id);

        return $this->view->response($idEditado, 200);
    }
}
  