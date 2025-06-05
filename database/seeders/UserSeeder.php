<?php

namespace App\Seeders;

use App\Database\Models\User;

class UserSeeder
{
    public function run(): void
    {
        
        User::truncate(); // Optional: clear table before seeding

        $password = password_hash('password', PASSWORD_ARGON2ID);

        $users = [
            ['name' => 'Marco', 'email' => 'marco@example.com', 'password' => $password ],
            ['name' => 'Alice', 'email' => 'alice@example.com', 'password' => $password ],
            ['name' => 'Bob', 'email' => 'bob@example.com', 'password' => $password ],
            ['name' => 'Admin', 'email' => 'admin@example.com', 'role' => 'admin', 'password' => $password ],
        ];

        foreach ($users as $data) {
            // $data['password'] = password_hash('password', PASSWORD_ARGON2ID);

            print_r($data);

            User::create($data);
        }

        echo "✅ Seeded users table.\n";
    }
}
