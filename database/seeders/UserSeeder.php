<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'first_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'phone_number' => '1111111111'
        ];

        User::create($data);
    }
}
