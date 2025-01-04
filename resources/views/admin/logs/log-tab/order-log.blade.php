<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="orderlogTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Changes</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderLogs as $log)
                    <tr>
                        {{-- ORDER ID --}}
                        <td>{{ $log->order->id ?? 'N/A' }}</td>

                        {{-- USERNAME --}}
                        <td>{{ $log->user->username ?? 'N/A' }}</td>

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
