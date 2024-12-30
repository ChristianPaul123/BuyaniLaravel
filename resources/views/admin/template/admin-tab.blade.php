<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">Admin tab template</h3>
    </div>
    @include('admin.includes.messageBox')
    <div class="card-body">
        <table id="admintabTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>admin table</th>
                    <th>admin table</th>
                    <th>admin table</th>
                    <th>admin table</th>
                    <th>admin table</th>
                    <th>admin table</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($records as $record)
                <tr>
                    <td>{{ $record->product_name }}</td>
                    <td>{{ $record->product_sold_stock }}</td>
                    <td>{{ $record->product_damage_stock }}</td>
                    <td>{{ $record->product_total_stock }}</td>
                    <td>${{ $record->total_profit }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->transfer_date)->format('F Y') }}</td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
