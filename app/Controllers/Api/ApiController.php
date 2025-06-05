<?php

// src/Controllers/Api/ApiController.php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Controllers\BaseController;

class ApiController extends BaseController {
    public function index(Request $request, string $name='Guest'): JsonResponse
    {
        return $this->json([
            'message' => "Hello $name!",
            'success' => true
        ]);

    }
}
