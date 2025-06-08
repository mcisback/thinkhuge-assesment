<?php

// src/Controllers/Api/ApiController.php
namespace App\Controllers\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use \App\Controllers\BaseController;

class ClientController extends BaseController {
    public function index(Request $request, int $userid): JsonResponse {
        try {

            $user = \App\Database\Models\User::with('movements')->findOrFail($userid);

        } catch(\Exception $e) {

            return $this->json([
                'message' => "User Not Found",
                'success' => false
            ], 404);

        }

        return $this->json([
            'message' => "User Found!",
            'data' => [
                'balance' => $user->balance(),
                'movements' => $user->movements,
            ],
            'success' => true
        ]);
    }
}
