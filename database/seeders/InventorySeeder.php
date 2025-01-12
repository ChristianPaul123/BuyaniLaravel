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
            // Randomly decide if the product is sold out (0 stock) or has available stock
            $isSoldOut = rand(0, 1) === 1; // 50% chance of being sold out

            // If the product is sold out, set all stock to 0
            if ($isSoldOut) {
                $totalProductStock = 0;
                $damageStock = 0;
                $soldStock = 0;
                $oldStock = 0;
                $newStock = 0;
            } else {
                // If the product is not sold out, assign realistic stock values
                $totalProductStock = rand(10, 100); // Total stock between 10 and 100
                $damageStock = rand(0, floor($totalProductStock * 0.1)); // Max 10% of total stock for damage
                $soldStock = rand(0, floor($totalProductStock * 0.5)); // Max 50% of total stock sold
                $oldStock = rand(1, $totalProductStock - $damageStock - $soldStock); // Remaining stock after sold and damaged
                $newStock = $totalProductStock - $damageStock - $oldStock - $soldStock; // Calculate new stock

                // Adjust to make sure new stock is at least 1 if the product is available
                if ($newStock <= 0) {
                    $newStock = 1;
                    $oldStock = $totalProductStock - $damageStock - $soldStock - $newStock; // Recalculate old stock
                }
            }

            Inventory::create([
                'product_id' => $product->id,
                'product_new_stock' => $newStock,
                'product_sold_stock' => $soldStock,
                'product_old_stock' => $oldStock,
                'product_total_stock' => $totalProductStock,
                'total_profit' => rand(1000, 10000), // Randomize profit
                'product_damage_stock' => $damageStock,
            ]);
        }
    }
 
}
