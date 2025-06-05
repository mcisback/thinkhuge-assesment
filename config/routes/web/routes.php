<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;

$apiRoutes = new RouteCollection();

$apiRoutes->add(
    'web.home', 
    new GetRoute(
        '/',
        [
            '_controller' => [App\Controllers\Web\HomeController::class, 'index'],
        ],
    )
);

return $apiRoutes;