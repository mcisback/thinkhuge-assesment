<?php

namespace App\Seeders;

use App\Database\Models\User;

class UserSeeder
{
    public function run(): void
    {
        
        User::truncate(); // Optional: clear table before seeding

        $password = my_password_hash('password');

        $users = [
            [
                'name' => 'Marco',
                'email' => 'marco@example.com',
                'password' => $password
            ],
            [
                'name' => 'Alice',
                'email' => 'alice@example.com',
                'password' => $password
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@example.com',
                'password' => $password
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => $password,
                'allow_login' => true,
                'api_key' => '286e72e79a69a3165bf913426c25221d51597349cd94fc2865b99fda050c2950',
            ],
        ];

        foreach ($users as $data) {
            // $data['password'] = my_password_hash('password');

            print_r($data);

            User::forceCreate($data);
        }

        echo "✅ Seeded users table.\n";
    }
}
