<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Prevent the SubCategory model events from firing.
     */
    use WithoutModelEvents;

    /**
     * The number of sub-categories to create.
     *
     * @var int
     */
    private CONST SUB_CATEGORY_COUNT = 50;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::factory()->count(self::SUB_CATEGORY_COUNT)->create();
    }
}
