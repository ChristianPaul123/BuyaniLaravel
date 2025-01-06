<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       // Hello Paul Team, Here is the user admin for testing purpose only 
        DB::table('users')->insert([
            [
                'username' => 'MyAdmin',
                'email' => 'myadmin@example.com',
                'password' => Hash::make('Admin12345678'),
                'first_name' => 'My',
                'last_name' => 'Admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        // Here is the user for testing purposes 
            [
                'username' => 'MyUser',
                'email' => 'myuser@example.com',
                'password' => Hash::make('User12345678'),
                'first_name' => 'My',
                'last_name' => 'User',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
