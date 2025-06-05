<?php

// src/Controller/Web/AuthController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController {
    public function login(Request $request): Response {
        [
            'email' => $email,
            'password' => $password,
        ] = $request->request->all();

        // Find user by email
        $user = User::where('email', $email)->first();

        // Check if user exists and verify password
        if (!$user || !password_verify($password, $user->password)) {
            // Optionally add flash message
            session()->getFlashBag()->add('error', 'Invalid credentials.');

            return new RedirectResponse('/');
        }

        // Log the user in (store in session)
        session()->set('auth', $user->id);

        return new RedirectResponse('/dashboard');
    }

    public function logout(Request $request) : Response {
        session()->remove('auth');

        return new RedirectResponse('/');
    }
}
