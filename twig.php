<?php

// Set up Twig
$twigLoader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twigLoader->addPath(__DIR__ . '/views/layouts');

$twig = new Environment(
    $twigLoader,
    [
        'cache' => false,
        // 'cache' => __DIR__ . '/cache/twig' // for production
    ]
);

// Assuming you already have $twig set up:
$twig->addFunction(new TwigFunction('env', function ($key, $default = null) {
    return env($key, $default); // your helper
}));