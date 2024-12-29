<?php

namespace App\Http\Controllers;

use App\Models\User_log;
use App\Models\Order_log;
USE App\Models\Product_log;
use App\Models\Record;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ReportManagementController extends Controller
{
    public function showInventoryReports()
{
    $inventories = Inventory::with('product')->get();
    $records = Record::all();

    return view('admin.report.inventory-index', compact('inventories', 'records'));
}


public function showLogsReports()
{
    $userLogs = User_log::with('user')->latest()->get(); // Fetch logs with user relationship
    $productLogs = Product_log::with('product')->get(); // Fetch logs with product relationship
    $orderLogs = Order_log::with('order')->get(); // Fetch logs with order relationship
    return view('admin.logs.log-index', compact('userLogs','productLogs','orderLogs')); // Pass logs to the view
}

}
