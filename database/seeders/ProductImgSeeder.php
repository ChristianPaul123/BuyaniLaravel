<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;


class ProductImgSeeder extends Seeder
{
    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;

    /**
     * The minimum number of product images to create for each product.
     *
     * @var int
     */
    private CONST FLOOR_PRODUCT_IMAGES = 1;

    /**
     * The maximum number of product images to create for each product.
     *
     * @var int
     */
    private CONST CEILING_PRODUCT_IMAGES = 5;

    /**
     * The Faker instance.
     *
     * @var $faker
     */
    protected $faker;

    /**
     * Construct the faker instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products
        $products = Product::all();

        // Create a new Faker instance
        $faker = Faker::create();

        // Create Product Images
        $products->each(function ($product) use ($faker) {
            $numberOfImages = $faker->numberBetween(
                self::FLOOR_PRODUCT_IMAGES,
                 self::CEILING_PRODUCT_IMAGES,
            );

            for ($i = 0; $i < $numberOfImages; $i++) {
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'img' => $faker->imageUrl(),
                ]);
            }
        });
    }
}
