<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;

$apiRoutes = new RouteCollection();

// Clients
$apiRoutes->add(
    'api.clients.movements', 
    new GetRoute(
        '/clients/{id}',
        [
            '_controller' => [App\Controllers\Api\ClientController::class, 'index'],
            '_middlewares' => ['apiAuth'],
        ],
    )
);

return $apiRoutes;