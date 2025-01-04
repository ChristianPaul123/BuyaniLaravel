<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->sentence(3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create subcategories along with the category.
     *
     * @param int $count
     *
     * @return $this
     */
    public function withSubcategories(int $count = 1): self
    {
        return $this->has(
            SubCategory::factory()->count($count),
            'subcategories'
        );
    }
}
