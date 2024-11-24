<div class="card">
    <div class="card-header">
        <h4>Current Inventory</h4>
    </div>
    <div class="card-body">
        <table id="currentInventoryTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>New Stock</th>
                    <th>Old Stock</th>
                    <th>Total Stock</th>
                    <th>Sold Stock</th>
                    <th>Damaged Stock</th>
                    <th>Total Profit</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->product->product_name }}</td>
                    <td>{{ $inventory->product_new_stock }}</td>
                    <td>{{ $inventory->product_old_stock }}</td>
                    <td>{{ $inventory->product_total_stock }}</td>
                    <td>{{ $inventory->product_sold_stock }}</td>
                    <td>{{ $inventory->product_damage_stock }}</td>
                    <td>${{ $inventory->total_profit }}</td>
                    <td>{{ $inventory->created_at->format('F Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
