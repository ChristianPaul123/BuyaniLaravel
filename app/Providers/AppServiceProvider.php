<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule)
    {
        // $schedule->command('app:generate-monthly-inventory-reports')->everyMinute()->sendOutputTo(storage_path('logs/monthly_inventory_reports.log'));
        // $schedule->command('app:generate-monthly-suggest-product-reports')->everyMinute()->sendOutputTo(storage_path('logs/monthly_suggested_products_reports.log'));

        Paginator::useBootstrapFive();
    }

}
