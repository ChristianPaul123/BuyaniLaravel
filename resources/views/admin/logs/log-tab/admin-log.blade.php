<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="adminlogTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Admin name</th>
                        <th>Admin email</th>
                        <th>Admin type</th>
                        <th>Status</th>
                        {{-- <th>Last Online</th> --}}
                        <th>Action</th>
                        <th>IP Address</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminLogs as $log)
                    <tr>
                        {{-- ID --}}
                        <td>{{ $log->id }}</td>

                        {{-- Admin name --}}
                        <td>{{ $log->admin->username ?? 'N/A' }}</td>

                        {{-- Admin email --}}
                         <td>{{ $log->admin->email ?? 'N/A' }}</td>

                        {{-- Admin Type --}}
                        <td><span class="badge bg-primary">{{ $log->admin->admin_type_label ?? 'N/A' }}</span></td>


                        {{-- Admin Status --}}
                    <td>
                        <span class="badge
                        {{ $log->admin->status == 1 ? 'bg-success' : 'bg-danger' }}">
                        {{ $log->admin->status == 1 ? 'Online' : 'Offline' }}
                        </span>
                    </td>

                    {{-- Moved to personal instead --}}
                        {{-- Last Online
                        <td> @if ($log->admin->last_online)
                            {{ \Carbon\Carbon::parse($log->admin->last_online)->diffForHumans() }}
                        @else
                            N/A
                        @endif
                        </td> --}}

                        {{-- STATUS --}}
                        <td>{{ $log->action ?? 'N/A' }}</td>

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
