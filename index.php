<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

// Load the route collection
$routes = require __DIR__ . '/config/routes.php';

// Create context based on the current request
$context = new RequestContext();
$context->fromRequest($request);

// Match the request URI to a route
$matcher = new UrlMatcher($routes, $context);

try {
    // print_r($request->getPathInfo());
    // echo "\n";

    $parameters = $matcher->match($request->getPathInfo());

    // print_r($parameters);

    // Extract the controller and run it
    [$controllerClass, $method] = $parameters['_controller'];

    unset($parameters['_controller'], $parameters['_route']); // cleanup

    print_r([$controllerClass, $method]);

    $controller = new $controllerClass();
    $response = $controller->$method($request, ...array_values($parameters));
} catch (Symfony\Component\Routing\Exception\ResourceNotFoundException) {
    $response = new Response('404 Not Found', 404);
} catch (Exception $e) {
    $response = new Response('500 Internal Server Error: ' . $e->getMessage(), 500);
}

$response->send();
