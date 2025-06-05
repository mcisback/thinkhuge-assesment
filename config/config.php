<?php

return [
    'app.root' => __DIR__ . '/../',

    'app.assets' => _env('APP_HOST', '') . '/assets',
    'app.assets.css' => _env('APP_HOST', '') . '/assets/css',
    'app.assets.js' => _env('APP_HOST', '') . '/assets/js',
    
    'app.paths.migrations' => __DIR__ . '/../database/migrations',
    'app.paths.seeders' => __DIR__ . '/../database/seeders',
];