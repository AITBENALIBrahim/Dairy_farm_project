<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('pass12345', PASSWORD_DEFAULT), // Hash the password
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data into the 'users' table
        $this->db->table('users')->insertBatch($data);
    }
}
