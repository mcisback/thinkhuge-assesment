<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use App\Routing\GetRoute;
use App\Routing\PostRoute;
use App\Routing\DeleteRoute;

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

// Clients
$webRoutes->add(
    'web.clients.create', 
    new PostRoute(
        '/clients/create',
        [
            '_controller' => [App\Controllers\Web\ClientController::class, 'create'],
            '_middlewares' => ['auth', 'csrf'],
        ],
    )
);

$webRoutes->add(
    'web.clients.show', 
    new GetRoute(
        '/clients/{id}',
        [
            '_controller' => [App\Controllers\Web\ClientController::class, 'show'],
            '_middlewares' => ['auth'],
        ],
    )
);

$webRoutes->add(
    'web.clients.delete', 
    new DeleteRoute(
        '/clients/{id}',
        [
            '_controller' => [App\Controllers\Web\ClientController::class, 'delete'],
            '_middlewares' => ['auth'],
        ],
    )
);

// Movements
$webRoutes->add(
    'web.movements.create', 
    new PostRoute(
        '/movements/create',
        [
            '_controller' => [App\Controllers\Web\MovementController::class, 'create'],
            '_middlewares' => ['auth', 'csrf'],
        ],
    )
);

$webRoutes->add(
    'web.movements.delete', 
    new DeleteRoute(
        '/movements/{id}',
        [
            '_controller' => [App\Controllers\Web\MovementController::class, 'delete'],
            '_middlewares' => ['auth'],
        ],
    )
);

return $webRoutes;