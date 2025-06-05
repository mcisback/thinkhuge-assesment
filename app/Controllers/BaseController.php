<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use \Twig\Environment as TwigEnv;

abstract class BaseController {
    // abstract public function index(Request $request, ...$parameters): Response;
    protected TwigEnv $twig;
    protected Request $request;

    public function __construct(Request $request, TwigEnv $twig) {
        $this->request = $request;
        $this->twig = $twig;
    }

    protected function render(string $template, array $params = []): Response {
        $template = str_replace('.', '/', $template);
        
        // Add .twig if not present
        if(!str_ends_with($template, '.twig')) {
            $template .= '.twig';
        }

        return new Response($this->twig->render($template, [
            ...$params,
            'flash' => session()->getFlashBag()->all(),
            'old' => $this->request->request->all(),
        ]));
    }

    protected function json(array $data, int $status = 200): JsonResponse {
        return new JsonResponse($data, $status);
    }
}
