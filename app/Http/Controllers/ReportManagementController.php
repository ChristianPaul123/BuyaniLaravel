<?php

namespace App\Http\Controllers;

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

}
