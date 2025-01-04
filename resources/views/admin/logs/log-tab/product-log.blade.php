<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="productlogTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Admin</th>
                        <th>Action</th>
                        <th>Changes</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productLogs as $log)
                    <tr>
                        {{-- PRODUCT NAME --}}
                        <td>{{ $log->product->name ?? 'N/A' }}</td>

                        {{-- ADMIN NAME --}}
                        <td>{{ $log->admin->name ?? 'N/A' }}</td>

                        {{-- ACTION --}}
                        <td>{{ $log->action }}</td>

                        {{-- CHANGES --}}
                        <td>
                            <pre style="background: #f8f9fa; padding: 5px; border-radius: 5px;">{{ $log->changes }}</pre>
                        </td>

                        {{-- TIMESTAMP --}}
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
