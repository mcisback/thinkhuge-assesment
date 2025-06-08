<?php

namespace App\Middlewares;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CsrfMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): Response
    {
        // Only check for CSRF on POST, PUT, DELETE, PATCH
        if (in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $token = $request->request->get('_token'); // from HTML form
            $sessionToken = session()->get('csrf_token');

            if (!$token || !$sessionToken || !hash_equals($sessionToken, $token)) {
                // JSON fallback if API
                if (str_starts_with($request->getPathInfo(), '/api')) {
                    return new JsonResponse(['error' => 'Invalid CSRF token'], 403);
                }

                return new Response('403 Forbidden: Invalid CSRF token', 403);
            }
        }

        return null; // Continue
    }
}
