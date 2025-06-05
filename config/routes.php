<?php

use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

// Load web routes
$webRoutes = require __DIR__ . '/routes/web/routes.php';
$routes->addCollection($webRoutes);

// Load API routes with /api prefix
$apiRoutes = require __DIR__ . '/routes/api/routes.php';

$apiRoutes->addPrefix('/api');
$apiRoutes->addDefaults([
    '_format' => 'json'
]);

$routes->addCollection($apiRoutes);

return $routes;
