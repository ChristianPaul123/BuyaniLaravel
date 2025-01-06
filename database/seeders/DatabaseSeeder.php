<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\{
    Admin,
    User,
};

class DatabaseSeeder extends Seeder
{
    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'admin_type' => 1,
            'profile_pic' => null,
            'status' => 1,
            'last_online' => null,
            'deactivated_date' => null,
            'deactivated_status' => 0,
            'admin_payment' => null,
        ]);
        
        // Create User
        User::create([
            'username' => 'user',
            'email' => 'user@email.com',
            'password' => bcrypt('password'),
            'user_type' => 1,
            'profile_pic' => null,
            'phone_number' => '09123456789',
            'status' => 1,
            'last_online' => null,
            'deactivated_status' => 0,
            'deactivated_date' => null,
            'deactivated_by' => null,
        ]);


        // Create posts
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            InventorySeeder::class,
            ProductImgSeeder::class,
            ProductSpecificationsSeeder::class,
        ]);
    }
}
