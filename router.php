<?php
require_once 'libs/router.php';
require_once 'app/controllers/oferta.api.controller.php';
    
// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('ofertas',        'GET',       'OfertaApiController',         'getAll');
$router->addRoute('ofertas',        'POST',      'OfertaApiController',         'create');
$router->addRoute('oferta/:id',     'GET',       'OfertaApiController',         'get');
$router->addRoute('oferta/:id',     'PUT',       'OfertaApiController',         'updateOferta');
$router->addRoute('oferta/categoria/:id', 'GET',   'OfertaApiController',       'getOfertasByCategoria' );


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);