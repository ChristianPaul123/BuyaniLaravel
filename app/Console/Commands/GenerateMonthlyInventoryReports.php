<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inventory;
use App\Models\Record;

class GenerateMonthlyInventoryReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-inventory-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy inventory data into the record table monthly';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $inventories = Inventory::all();
        foreach ($inventories as $inventory) {
            Record::create([
                'product_name' => $inventory->product->product_name,
                'product_sold_stock' => $inventory->product_sold_stock,
                'product_damage_stock' => $inventory->product_damage_stock,
                'product_total_stock' => $inventory->product_total_stock,
                'transfer_date' => now(),
                'total_profit' => $inventory->total_profit,
            ]);
        }

        $this->info('Monthly report generated successfully.');
    }
}
