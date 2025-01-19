<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">Current Inventory</h3>
    </div>
    @include('admin.includes.messageBox')
    <div class="card-body">
        <table id="currentInventoryTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inventory->product->product_name ?? 'N/A' }}</td>
                    <td>{{ $inventory->product_new_stock }}</td>
                    <td>{{ $inventory->product_old_stock }}</td>
                    <td>{{ $inventory->product_total_stock }}</td>
                    <td>{{ $inventory->product_sold_stock }}</td>
                    <td>{{ $inventory->product_damage_stock }}</td>
                    <td>₱{{ $inventory->total_profit }}</td>
                    <td>{{ $inventory->created_at->format('F Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
