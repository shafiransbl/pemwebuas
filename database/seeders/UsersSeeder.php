<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
            [
                'name'=> 'admin',
                'email'=> 'admin@gmail.com',
                'role'=> 'admin',
                'password'=> bcrypt('admin123'),
            ],
            [
                'name'=> 'user',
                'email'=> 'user@gmail.com',
                'role'=> 'user',
                'password'=> bcrypt('users123'),
            ]
        ];
        foreach ($userdata as $key => $value) {
            User::create($value);
    }
}
}