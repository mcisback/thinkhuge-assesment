<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (env('APP_DEBUG') === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$twig = require_once __DIR__ . '/twig.php';

$request = Request::createFromGlobals();

// Load the route collection
$routes = require __DIR__ . '/config/routes.php';

// NOTE: Print all routes
// foreach ($routes as $name => $route) {
//     echo "$name: " . $route->getPath() . "\n";
// }

// Create context based on the current request
$context = new RequestContext();
$context->fromRequest($request);

// Match the request URI to a route
$matcher = new UrlMatcher($routes, $context);
$response = null;

try {
    // print_r($request->getPathInfo());
    // echo "\n";

    $parameters = $matcher->match(
        $request->getPathInfo()
    );

    // print_r($parameters);

    // Extract the controller and run it
    [$controllerClass, $method] = $parameters['_controller'];

    $requestFormat = $parameters['_format'] ?? 'html';

    unset($parameters['_controller'], $parameters['_route'], $parameters['_format']); // cleanup

    // print_r([$controllerClass, $method]);

    $controller = new $controllerClass($twig);
    $response = $controller->$method($request, ...array_values($parameters));

} catch (Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
    // Check if the URL starts with /api
    if ($requestFormat === 'json') {
        $response = new JsonResponse([
            'error' => 'Not Found',
            'status' => 404,
        ], 404);
    } else {
        $response = new Response('404 Not Found', 404);
    }

} catch (Symfony\Component\Routing\Exception\MethodNotAllowedException $e) {
    if ($requestFormat === 'json') {
        $response = new JsonResponse([
            'error' => 'Method Not Allowed',
            'allowed_methods' => $e->getAllowedMethods(),
            'status' => 405,
        ], 405);
    } else {
        $response = new Response('405 Method Not Allowed', 405);
    }

} catch (Throwable $e) {
    if ($requestFormat === 'json') {
        $response = new JsonResponse([
            'error' => 'Internal Server Error',
            'message' => $e->getMessage(),
            'status' => 500,
        ], 500);
    } else {
        $response = new Response('500 Internal Server Error: ' . $e->getMessage(), 500);
    }
}

$response->send();
