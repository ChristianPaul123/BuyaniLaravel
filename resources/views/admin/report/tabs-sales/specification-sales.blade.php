<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">Specific Product Sales Report</h3>
    </div>
    @include('admin.includes.messageBox')
    <div class="card-body">
        <table id="specificproductsalesTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Specific Product Name</th>
                    <th>Product Name</th>
                    <th>Order Count</th>
                    <th>Total Sales</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($specificProductSales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->productSpecification->specific_name ?? 'No Specific Product' }}</td>
                    <td>{{ $sale->productSales->product->product_name ?? 'No Product' }}</td>
                    <td>{{ $sale->order_count }}</td>
                    <td>${{ $sale->total_sales }}</td>
                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
