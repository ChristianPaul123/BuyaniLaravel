<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::command('app:generate-monthly-inventory-reports')->monthly()->sendOutputTo(storage_path('logs/monthly_inventory_reports.log'));
// Schedule::command('app:generate-monthly-suggest-product-reports')->monthly()->sendOutputTo(storage_path('logs/monthly_suggested_products_reports.log'));
