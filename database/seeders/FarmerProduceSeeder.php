<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmerProduceSeeder extends Seeder
{   
    /**
     * The number of produce to create.
     */
    protected const PRODUCE_COUNT = 5;

    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;

    /**
     * The Faker instance.
     */
    public $faker;

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
        $farmers = User::where('user_type', 2)->get();

        foreach ($farmers as $farmer) {
            for ($i = 0; $i < self::PRODUCE_COUNT; $i++) {
                $farmer->farmerProduces()->create([
                    'user_id' => $farmer->id,
                    'produce_name' => $this->faker->word,
                    'produce_description' => $this->faker->sentence,
                    'produce_image' => $this->faker->imageUrl(),
                ]);
            }
        }
    }
}
