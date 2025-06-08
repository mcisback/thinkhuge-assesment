<?php

namespace App\Seeders;

require_once __DIR__ . '/../../bootstrap/database.php';

use Illuminate\Database\Capsule\Manager as DB;

class DatabaseSeeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        (new UserSeeder())->run();
        (new MovementSeeder())->run();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
