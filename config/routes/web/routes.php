<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;
use App\Routing\PostRoute;

$webRoutes = new RouteCollection();

// Home
$webRoutes->add(
    'web.home', 
    new GetRoute(
        '/',
        [
            '_controller' => [App\Controllers\Web\HomeController::class, 'index'],
        ],
    )
);

// Dashboard
$webRoutes->add(
    'web.dashboard', 
    new GetRoute(
        '/dashboard',
        [
            '_controller' => [App\Controllers\Web\DashboardController::class, 'index'],
            '_middlewares' => ['auth'],
        ],
    )
);

$webRoutes->add(
    'web.dashboard.clients', 
    new GetRoute(
        '/dashboard/clients',
        [
            '_controller' => [App\Controllers\Web\DashboardController::class, 'clientsPage'],
            '_middlewares' => ['auth'],
        ],
    )
);

// Auth
$webRoutes->add(
    'web.login', 
    new PostRoute(
        '/login',
        [
            '_controller' => [App\Controllers\Web\AuthController::class, 'login'],
            '_middlewares' => ['csrf'],
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