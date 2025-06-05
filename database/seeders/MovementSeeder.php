<?php

namespace App\Seeders;

use App\Models\Movement;
use App\Models\User;

class MovementSeeder
{
    public function run(): void
    {
        Movement::truncate(); // Optional: clear table before seeding

        $users = User::all();

        foreach ($users as $user) {
            print_r($user->name);

            Movement::create([
                'type' => 'deposit',
                'amount' => 200000,
            ])->associate($user);
        }

        echo "✅ Seeded users table.\n";
    }
}
