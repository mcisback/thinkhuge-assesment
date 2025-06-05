<?php

// src/Controller/Web/HomeController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controllers\BaseController;

class HomeController extends BaseController {
    public function index(Request $request): Response
    {
        if(session()->get('auth')) {
            return new RedirectResponse('/dashboard');
        }

        return $this->render('home.index');
    }
}
