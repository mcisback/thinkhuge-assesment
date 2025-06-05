<?php

// src/Controller/Web/HomeController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Controllers\BaseController;

class HomeController extends BaseController {
    public function index(Request $request, string $name): Response
    {
        return $this->render('home/index.twig', ['name' => $name]);
    }
}
