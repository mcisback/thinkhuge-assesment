<?php

namespace App\Seeders;

require_once __DIR__ . '/../../bootstrap/database.php';

class DatabaseSeeder
{
    public function run(): void
    {
        (new UserSeeder())->run();
    }
}
