<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">Past Inventory Record</h3>
    </div>
    @include('admin.includes.messageBox')
    <div class="card-body">
        <table id="specificproductsalesTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Specification</th>
                    <th>Order Quantity</th>
                    <th>Total Sales</th>
                    <th>Sales Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($specificproductsales  as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $record->productSpecification->specification_name ?? 'N/A' }}</td>
                    <td>{{ $record->order_quantity }}</td>
                    <td>${{ $record->total_sales }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->date)->format('F Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
