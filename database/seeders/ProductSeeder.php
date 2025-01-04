<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * The number of products to create.
     *
     * @var int
     */
    private CONST PRODUCT_COUNT = 50;

    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Products
        Product::factory()->count(self::PRODUCT_COUNT)->create();
    }
}
