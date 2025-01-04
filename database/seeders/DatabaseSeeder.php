<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create posts
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ProductImgSeeder::class,
        ]);
    }
}
