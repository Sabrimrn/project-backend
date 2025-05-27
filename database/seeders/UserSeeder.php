<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
          User::create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'username' => 'admin1',
            'password' => Hash::make('Password!321'),
            'about_me' => 'I am the admin.',
            'birthday' => '1990-01-01',
            'is_admin' => true,
        ]); 

        // Create normal users
        $users = [
            [
                'name' => 'John',
                'email' => 'john@gaming.com',
                'password' => Hash::make('password'),
                'username' => 'ProGamer2024',
                'about_me' => 'Professional esports player specializing in FPS games.',
                'birthday' => '1995-06-15',
                'is_admin' => false,
            ],
            [
                'name' => 'Sarah',
                'email' => 'sarah@gaming.com',
                'password' => Hash::make('password'),
                'username' => 'RPGMaster',
                'about_me' => 'Love RPGs and adventure games. Always exploring new worlds!',
                'birthday' => '1992-03-22',
                'is_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
