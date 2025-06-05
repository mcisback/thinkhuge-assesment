<?php

namespace App\Seeders;

use App\Database\Models\Movement;
use App\Database\Models\User;

class MovementSeeder
{
    public function run(): void
    {
        Movement::truncate(); // Optional: clear table before seeding

        $users = User::clients();

        foreach ($users as $user) {
            echo "[+] Seeding movement for {$user->name}\n";

            Movement::create([
                'type' => 'deposit',
                'amount' => 2000*100,
                'user_id' => $user->id,
            ]);
        }

        echo "✅ Seeded movements table.\n";
    }
}
