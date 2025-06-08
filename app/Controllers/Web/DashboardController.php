<?php

// src/Controller/Web/HomeController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controllers\BaseController;
use App\Database\Models\User;

class DashboardController extends BaseController {
    public function index(Request $request): Response
    {
        return $this->render('dashboard.index', [
            'report' => [
                'balance' => 1250.00,
                'movements' => [
                    ['label' => 'Deposit', 'amount' => 1000],
                    ['label' => 'Purchase', 'amount' => -250],
                ],
            ]
        ]);
    }

    public function clientsPage(Request $request) : Response {
        $clients = User::clients();

        return $this->render('dashboard.clients', [
            'clients' => $clients,
        ]);
    }
}
