<?php

namespace App\Middlewares;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ApiAuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): ?JsonResponse
    {
        $bearer = $request->headers->get('Authorization');

        if (!$bearer || !str_starts_with($bearer, 'Bearer ')) {
            return new JsonResponse([
                'error' => 'Forbidden',
                'status' => 403,
            ], 403);
        }

        $token = substr($bearer, 7);

        $user = \App\Database\Models\User::where('api_key', $token)->first();

        if(!$user) {
            return new JsonResponse([
                'error' => 'Invalid API KEY',
                'status' => 403,
            ], 403);
        }

        if($user->role !== 'admin') {
            return new JsonResponse([
                'error' => 'User Not Authorized',
                'status' => 403,
            ], 403);
        }

        session()->set('user', $user);

        return null; // Continue to controller
    }
}
