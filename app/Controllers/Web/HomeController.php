<?php

// src/Controller/HomeController.php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Controllers\BaseController;

class HomeController extends BaseController {
    public function index(Request $request, string $name='Guest'): Response
    {
        return new Response("Hello $name!");
    }
}
