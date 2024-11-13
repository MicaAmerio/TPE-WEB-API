<?php
require_once 'libs/api.router.php';
require_once 'app/controllers/producto.api.controller.php';
    
// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('productos',        'GET',       'ProductoApiController',         'getAll');
$router->addRoute('productos',        'POST',      'ProductoApiController',         'create');
$router->addRoute('producto/:id',     'GET',       'ProductoApiController',         'get');
$router->addRoute('producto/:id',     'DELETE',    'ProductoApiController',         'delete');
$router->addRoute('producto/:id',     'PUT',       'ProductoApiController',         'update');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);