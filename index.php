<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

require_once __DIR__ . '/bootstrap/dotenv.php';

require_once __DIR__ . '/bootstrap/session.php';

if (_env('APP_DEBUG') === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

// Bootstrap ORM
require_once __DIR__ . '/bootstrap/database.php';

$twig = require_once __DIR__ . '/bootstrap/twig.php';

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
$requestFormat = 'html';

$middlewareMap = require __DIR__ . '/config/middlewares.php';

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

    $request->attributes->set('_format', $requestFormat);

    $middlewares = $parameters['_middlewares'] ?? [];

    foreach ($middlewares as $alias) {
        if (!isset($middlewareMap[$alias])) {
            throw new Exception("Middleware [$alias] not found.");
        }

        $middlewareClass = $middlewareMap[$alias];
        $middleware = new $middlewareClass();

        $response = $middleware->handle($request);

        if ($response instanceof Response) {
            $response->send();

            exit;
        }
    }

    // Cleanup all '_key' parameters
    foreach($parameters as $key => $value) {
        if(str_starts_with($key, '_')) {
            unset($parameters[ $key ]);
        }
    }

    // print_r([$controllerClass, $method]);

    $controller = new $controllerClass($request, $twig);
    $response = $controller->$method($request, ...array_values($parameters));

} catch (Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
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
