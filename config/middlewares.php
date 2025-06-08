<?php

return [
    'auth' => \App\Middlewares\AuthMiddleware::class,
    'apiAuth' => \App\Middlewares\ApiAuthMiddleware::class,
    'csrf' => \App\Middlewares\CsrfMiddleware::class,
];
