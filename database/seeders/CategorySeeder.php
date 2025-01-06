<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Prevent the Category model events from firing.
     */
    use WithoutModelEvents;

    /**
     * The number of categories to create.
     *
     * @var int
     */

    private CONST CATEGORY_COUNT = 5;

    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        Category::factory()->count(self::CATEGORY_COUNT)->withSubcategories(2)->create();
    }
}
