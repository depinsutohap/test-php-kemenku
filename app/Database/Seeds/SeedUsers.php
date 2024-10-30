<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\User;

class SeedUsers extends Seeder
{
    public function run()
    {
        $user = new User();
        $faker = \Faker\Factory::create();

        $user->save([
            'email' => "admin@gmail.com",
            'role' => "admin",
            'password' => password_hash("admin1",PASSWORD_BCRYPT)
        ]);

        $user->save([
            'email' => "client@gmail.com",
            'role' => "client",
            'password' => password_hash("client1",PASSWORD_BCRYPT)
        ]);
    }
}
