<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class InventorySeeder extends Seeder
{
    /**
     * Use the WithoutModelEvents trait to prevent the Product model events from firing.
     */
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $totalProductStock = rand(1, 100);

            Inventory::create([
                'product_id' => $product->id,
                'product_new_stock' => $totalProductStock,
                'product_sold_stock' => ceil($totalProductStock * 0.4),
                'product_old_stock' => ceil($totalProductStock * 0.5),
                'product_total_stock' => $totalProductStock,
                'total_profit' => rand(1, 100),
                'product_damage_stock' => ceil($totalProductStock * 0.1),
            ]);
        }
    }
}
