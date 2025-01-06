<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="userlogTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Login Field</th>
                        <th>IP Address</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userLogs as $log)
                    <tr>
                        {{-- ID --}}
                        <td>{{ $log->id }}</td>

                        {{-- USER --}}
                        <td>{{ $log->user->username ?? 'N/A' }}</td>

                        {{-- PHONE NUMBER --}}
                        <td>{{ $log->phone_number ?? 'N/A' }}</td>

                        {{-- EMAIL --}}
                        <td>{{ $log->email ?? 'N/A' }}</td>

                        {{-- STATUS --}}
                        <td>
                            <span class="badge {{ $log->status === 'success' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($log->status) }}
                            </span>
                        </td>

                        {{-- LOGIN FIELD --}}
                        <td>{{ $log->login_field }}</td>

                        {{-- IP ADDRESS --}}
                        <td>{{ $log->ip_address }}</td>

                        {{-- TIMESTAMP --}}
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
