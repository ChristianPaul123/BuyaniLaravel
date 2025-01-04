<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a Category with one SubCategory
        $randomCategory = Category::inRandomOrder()->first();
        $subcategory = SubCategory::where('category_id', $randomCategory->id)
            ->inRandomOrder()->first();

        return [
            'product_name' => $this->faker->sentence(3),
            'product_pic' => $this->faker->imageUrl(),
            'product_details' => $this->faker->text,
            'product_status' => null,
            'category_id' => $randomCategory->id,
            'subcategory_id' => $subcategory->id,
            'product_deactivated' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
        ];
    }
}
