<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;
use App\Routing\PostRoute;

$webRoutes = new RouteCollection();

$webRoutes->add(
    'web.home', 
    new GetRoute(
        '/',
        [
            '_controller' => [App\Controllers\Web\HomeController::class, 'index'],
        ],
    )
);

$webRoutes->add(
    'web.dashboard', 
    new GetRoute(
        '/dashboard',
        [
            '_controller' => [App\Controllers\Web\DashboardController::class, 'index'],
        ],
    )
);

$webRoutes->add(
    'web.login', 
    new PostRoute(
        '/login',
        [
            '_controller' => [App\Controllers\Web\AuthController::class, 'login'],
        ],
    )
);

$webRoutes->add(
    'web.logout', 
    new GetRoute(
        '/logout',
        [
            '_controller' => [App\Controllers\Web\AuthController::class, 'logout'],
        ],
    )
);

return $webRoutes;