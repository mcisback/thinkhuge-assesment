<?php

use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

// Load API routes with /api prefix
$apiRoutes = require __DIR__ . '/routes/api/routes.php';

$apiRoutes->addPrefix('/api');
$apiRoutes->addDefaults([
    '_format' => 'json'
]);

$routes->addCollection($apiRoutes);

// You can repeat for other groups:
$webRoutes = require __DIR__ . '/routes/web/routes.php';
$routes->addCollection($webRoutes);

return $routes;
