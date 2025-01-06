<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSpecification>
 */
class ProductSpecificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 50), // Assuming 50 products exist
            'specification_name' => $this->faker->words(3, true), // Random specification name
            'product_price' => $this->faker->randomFloat(2, 10, 500), // Random price between 10 and 500
            'product_kg' => $this->faker->randomFloat(1, 1, 100), // Random weight between 1 and 100 kg
            'admin_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
