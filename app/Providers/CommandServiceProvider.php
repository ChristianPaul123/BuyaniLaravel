<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\GenerateMonthlyInventoryReports;
use App\Console\Commands\GenerateMonthlySuggestProductReports;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->commands([
            GenerateMonthlyInventoryReports::class,
            GenerateMonthlySuggestProductReports::class,
        ]);
    }
}
