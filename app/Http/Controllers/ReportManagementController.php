<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User_log;
use App\Models\Admin_Log;
USE App\Models\Product_log;
use App\Models\Inventory;
use App\Models\Order_log;
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
    $userLogs = User_log::with('user')->latest()->get(); // Fetch logs with user relationship
    $productLogs = Product_log::with('product')->get(); // Fetch logs with product relationship
    $orderLogs = Order_log::with('order')->get(); // Fetch logs with order relationship
    $adminLogs = Admin_Log::with('admin')->get(); // Fetch logs with admin relationship
    return view('admin.logs.log-index', compact('userLogs','productLogs','orderLogs','adminLogs')); // Pass logs to the view
}

}
