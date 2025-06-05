<?php

require_once __DIR__ . '/dotenv.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule = new Capsule;

// Load connection settings (or hardcode here)
$capsule->addConnection([
    'driver'    => _env('DB_DRIVER', 'mysql'),
    'host'      => _env('DB_HOST'),
    'database'  => _env('DB_NAME'),
    'username'  => _env('DB_USER'),
    'password'  => _env('DB_PASS'),
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();
