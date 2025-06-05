<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;

$apiRoutes = new RouteCollection();

$apiRoutes->add(
    'api.greet', 
    new GetRoute(
        '/greet/{name}',
        [
            '_controller' => [App\Controllers\Api\ApiController::class, 'index'],
        ],
    )
);

return $apiRoutes;