<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;

$routes = new RouteCollection();

$routes->add(
    'api_greet', 
    new GetRoute(
        '/greet/{name}',
        [
            '_controller' => [App\Controllers\Api\ApiController::class, 'index'],
        ],
    )
);

return $routes;