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

            $deposit = mt_rand(5000, 20000);

            echo "[+] Adding deposit {$deposit}€ to {$user->name}\n";

            Movement::create([
                'type' => 'deposit',
                'amount' => $deposit*100,
                'user_id' => $user->id,
            ]);

            for($i = 0; $i < 10; $i++) {
                // expense|earning
                $type = random_int(0, 1) === 0 ? 'expense' : 'earning';
                $amount = mt_rand(500, 10000);
                $sign = $type === 'earning' ? '+' : '-';

                echo "[+] Adding movement $sign{$amount}€ to {$user->name}\n";

                Movement::create([
                    'type' => $type,
                    'amount' => $amount*100,
                    'user_id' => $user->id,
                ]);
            }
        }

        echo "✅ Seeded movements table.\n";
    }
}
