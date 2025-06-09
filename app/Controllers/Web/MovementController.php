<?php

// src/Controller/Web/AuthController.php
namespace App\Controllers\Web;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controllers\BaseController;
use App\Database\Models\Movement;

class MovementController extends BaseController {
    public function create(Request $request): Response {
        $data = $request->request->all();

        $data['amount'] = floatval($data['amount']) * 100;

        // print_r($data);
        // exit;

        try {
            Movement::create( $data );

            session()->getFlashBag()->add('success', 'Movement Added');
        } catch(\Exception $e) {
            session()->getFlashBag()->add('error', 'Error: ' . $e->getMessage());
        }

        return new RedirectResponse($this->referer);
    }

    public function delete(Request $request, int $id): Response {

        try {
            Movement::destroy($id);

            session()->getFlashBag()->add('success', "Movement $id deleted");
        } catch(\Exception $e) {
            session()->getFlashBag()->add('error', 'Error: ' . $e->getMessage());
        }

        return new RedirectResponse($this->referer);
    }
}
