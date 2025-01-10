<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomUsersSeeder extends Seeder
{
    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;

    /**
     * Number of farmers to create.
     * @var int
     */
    protected const FARMER_COUNT = 100;

    /**
     * Number of users to create.
     * @var int
     */
    protected const USER_COUNT = 100;

    /**
     * The Faker instance.
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new faker instance.
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create farmers
        for ($i = 0; $i < self::FARMER_COUNT; $i++) {
            User::create([
                'username' => $this->faker->userName,
                'email' => $this->faker->email,
                'password' => bcrypt('password'),
                'user_type' => 2,
                'profile_pic' => null,
                'phone_number' => $this->faker->phoneNumber,
                'status' => 1,
                'last_online' => null,
                'deactivated_status' => 0,
                'deactivated_date' => null,
                'deactivated_by' => null,
            ]);
        }

        // Create users
        for ($i = 0; $i < self::USER_COUNT; $i++) {
            User::create([
                'username' => $this->faker->userName,
                'email' => $this->faker->email,
                'password' => bcrypt('password'),
                'user_type' => 1,
                'profile_pic' => null,
                'phone_number' => $this->faker->phoneNumber,
                'status' => 1,
                'last_online' => null,
                'deactivated_status' => 0,
                'deactivated_date' => null,
                'deactivated_by' => null,
            ]);
        }
    }
}
