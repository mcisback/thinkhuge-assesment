<?php

// src/Controller/Web/AuthController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controllers\BaseController;
use App\Database\Models\User;
use App\Database\Models\Movement;

class ClientController extends BaseController {
    public function create(Request $request): Response {
        $data = $request->request->all();

        $data['password'] = my_password_hash( $data['password'] );

        try {

            $user = User::create( $data );

            Movement::create([
                'type' => 'deposit',
                'amount' => intval( floatval($data['deposit']) * 100 ),
                'user_id' => $user->id,
            ]);

            session()->getFlashBag()->add('success', 'User Added');

        } catch(\Exception $e) {
            session()->getFlashBag()->add('error', 'Error: ' . $e->getMessage());
        }

        return new RedirectResponse($this->referer);
    }

    public function delete(Request $request, int $userId): Response {

        try {
            User::destroy($userId);

            session()->getFlashBag()->add('success', "User $userId deleted");
        } catch(\Exception $e) {
            session()->getFlashBag()->add('error', 'Error: ' . $e->getMessage());
        }

        return new RedirectResponse($this->referer);
    }

    // Show One Client
    public function show(Request $request, int $userId): Response {
        try {

            $client = User::with('movements')->findOrFail($userId);
            $client->balance = $client->balance() / 100;

            return $this->render('dashboard.client-report', [
                'client' => $client,
                'movements' => $client->movements,
            ]);

        } catch(\Exception $e) {
            session()->getFlashBag()->add('error', 'Error: ' . $e->getMessage());
        }

        return new RedirectResponse($this->referer);
    }
}
