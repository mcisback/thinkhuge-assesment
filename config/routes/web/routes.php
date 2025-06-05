<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;

$apiRoutes = new RouteCollection();

$apiRoutes->add(
    'web_greet', 
    new GetRoute(
        '/greet/{name}',
        [
            '_controller' => [App\Controllers\Web\HomeController::class, 'index'],
        ],
    )
);

return $apiRoutes;