<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use \Twig\Environment as TwigEnv;

abstract class BaseController {
    // abstract public function index(Request $request, ...$parameters): Response;
    protected TwigEnv $twig;

    public function __construct(TwigEnv $twig) {
        $this->twig = $twig;
    }

    protected function render(string $template, array $params = []): Response {
        return new Response($this->twig->render($template, $params));
    }

    protected function json(array $data, int $status = 200): JsonResponse {
        return new JsonResponse($data, $status);
    }
}
