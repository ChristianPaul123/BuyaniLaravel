<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Listeners\LogFailedLogin;
use Illuminate\Auth\Events\Login;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Failed;
use App\Models\ProductSpecification;
use Illuminate\Pagination\Paginator;
use App\Listeners\LogSuccessfulLogin;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use App\Observers\ProductSpecificationObserver;


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
        $schedule->command('app:generate-monthly-inventory-reports')->monthly()->sendOutputTo(storage_path('logs/monthly_inventory_reports.log'));
        $schedule->command('app:generate-monthly-suggest-product-reports')->monthly()->sendOutputTo(storage_path('logs/monthly_suggested_products_reports.log'));
        Order::observe(OrderObserver::class);
        Product::observe(ProductObserver::class);
        ProductSpecification::observe(ProductSpecificationObserver::class);
        // User::observe(UserObserver::class);
        Paginator::useBootstrapFive();
    }

}
