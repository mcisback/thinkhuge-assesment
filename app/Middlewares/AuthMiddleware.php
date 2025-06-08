<?php

namespace App\Middlewares;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): ?RedirectResponse
    {
        if (!session()->has('auth')) {
            return new RedirectResponse('/login');
        }

        return null; // Continue to controller
    }
}
