<?php

// src/Controller/Web/HomeController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controllers\BaseController;
use App\Database\Models\User;
use App\Database\Models\Movement;

class DashboardController extends BaseController {
    public function index(Request $request): Response
    {
        if($request->query->has('range') && $request->query->get('range') !== 'all' ) {
            $from = $request->query->get('from');
            $to = $request->query->get('to');

            $movements = Movement::with(['user:id,name'])
                ->when($from && $to, function ($query) use ($from, $to) {
                    $query->whereBetween('created_at', [$from, $to]);
                })
                ->get();
        } else {
            $movements = Movement::with(['user:id,name'])->get();
        }

        $balance = 0;

        $movements = $movements->map(function ($mov) use(&$balance) {
            $mov->amount = $mov->amount / 100;

            $sign = 1;

            if($mov->type === 'expense') {
                $sign = -1;
            }

            $balance += ($mov->amount * $sign);

            return $mov;
        });

        return $this->render('dashboard.index', [
            'report' => [
                'balance' => $balance,
                'movements' => $movements,
            ]
        ]);
    }

    public function clientsPage(Request $request) : Response {
        $clients = User::clients()->map(function($client) {
            $client->balance = $client->balance() / 100;

            return $client;
        });

        return $this->render('dashboard.clients', [
            'clients' => $clients,
        ]);
    }
}
