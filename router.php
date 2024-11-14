<?php
require_once 'libs/api.router.php';
require_once 'app/controllers/oferta.api.controller.php';
    
// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('ofertas',        'GET',       'OfertaApiController',         'getAll');
$router->addRoute('ofertas',        'POST',      'OfertaApiController',         'create');
$router->addRoute('oferta/:id',     'GET',       'OfertaApiController',         'get');
$router->addRoute('oferta/:id',     'PUT',       'OfertaApiController',         'updateferta');
$router->addRoute('oferta/categoria/:id', 'GET',   'OfertaApiController',         'get' );


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);