<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\UserLog;
use App\Models\AdminLog;
USE App\Models\ProductLog;
use App\Models\Inventory;
use App\Models\OrderLog;
use App\Models\ProductSales;
use Illuminate\Http\Request;
use App\Models\SpecificProductSales;

class ReportManagementController extends Controller
{
    public function showInventoryReports()
{
    $inventories = Inventory::with('product')->get();
    $records = Record::all();

    return view('admin.report.inventory-index', compact('inventories', 'records'));
}

public function showSalesReports()
{
    $productsales = ProductSales::with('product')->get();
    $specificproductsales = SpecificProductSales::with('productSpecification')->get();

    return view('admin.report.sales-index', compact('productsales', 'specificproductsales'));
}

public function showLogsReports()
{
    $userLogs = UserLog::with('user')->latest()->get(); // Fetch logs with user relationship
    $productLogs = ProductLog::with('product')->get(); // Fetch logs with product relationship
    $orderLogs = OrderLog::with('order')->get(); // Fetch logs with order relationship
    $adminLogs = AdminLog::with('admin')->get(); // Fetch logs with admin relationship
    return view('admin.logs.log-index', compact('userLogs','productLogs','orderLogs','adminLogs')); // Pass logs to the view
}

}
