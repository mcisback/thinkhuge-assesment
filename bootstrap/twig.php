<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

// Set up Twig
$twigLoader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twigLoader->addPath(__DIR__ . '/../views/layouts');

$twig = new Environment(
    $twigLoader,
    [
        'cache' => false,
        // 'cache' => __DIR__ . '/cache/twig' // for production
    ]
);

$twig->addFunction(new TwigFunction('env', function ($key, $default = null) {
    return _env($key, $default);
}));

$twig->addFunction(new TwigFunction('config', function ($key, $default = null) {
    return config($key, $default);
}));

$twig->addFunction(new TwigFunction('assets', function ($path) {
    return rtrim(config('app.assets') ?? '', '/') . '/' . ltrim($path, '/');
}));

return $twig;