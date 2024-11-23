<!-- Manage Admins Tab -->
<div class="tab-pane fade" id="manage-admins" role="tabpanel" aria-labelledby="manage-admins-tab">
    <div class="table-responsive">
        <table id="adminTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin Type</th>
                    <th>Status</th>
                    <th>Deactivation Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->username }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @switch($admin->admin_type)
                            @case(1) Owner @break
                            @case(2) Assistant @break
                            @case(3) Employee @break
                        @endswitch
                    </td>
                    <td>{{ $admin->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $admin->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                    <td class="table-action-buttons">
                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        @if($admin->deactivated_status == 0)
                            <form action="{{ route('admin.deactivate', $admin->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">Deactivate</button>
                            </form>
                        @else
                            <form action="{{ route('admin.activate', $admin->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Activate</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="admin_type">Admin Type</label>
                        <select name="admin_type" id="admin_type" class="form-control" required>
                            <option value="2">Assistant</option>
                            <option value="3">Employee</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
