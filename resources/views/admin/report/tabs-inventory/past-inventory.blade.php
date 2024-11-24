<div class="card">
    <div class="card-header">
        <h4>Past Inventory Records</h4>
    </div>
    <div class="card-body">
        <table id="pastInventoryTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Sold Stock</th>
                    <th>Damaged Stock</th>
                    <th>Total Stock</th>
                    <th>Total Profit</th>
                    <th>Transfer Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{ $record->product_name }}</td>
                    <td>{{ $record->product_sold_stock }}</td>
                    <td>{{ $record->product_damage_stock }}</td>
                    <td>{{ $record->product_total_stock }}</td>
                    <td>${{ $record->total_profit }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->transfer_date)->format('F Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
