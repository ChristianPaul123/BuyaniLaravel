<!-- Manage Admins Tab -->

<section class="min-height">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Manage Admins</h3>
                <!-- Add Admin Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    <i class="fa fa-plus"></i> Add Admin
                </button>
            </div>
<div>
    <div class="table-responsive">
        <table id="adminTable" class="table table-bordered">
          <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin Type</th>
                    <th>Online Status</th>
                    <th>Last Online</th>
                    <th>Deactivated Date</th>
                    <th>Deactived Status</th>
                    <th>Edit</th>
                    <th>Action</th>
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
                    <td>{{ $admin->last_online }}</td>
                    <td>{{ $admin->deactivated_date }}</td>
                    <td>{{ $admin->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>

                    <td>
                        <a href="{{ route('admin.edit', $admin->id) }}" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        @if($admin->deactivated_status == 0)
                            <form id="deactivateAdminForm" action="{{ route('admin.deactivate', $admin->id) }}" method="POST" class="d-inline" style="display:inline;">
                                @csrf
                                <button id="deactivateAdminModal" type="button" title="Accept" class="btn btn-danger btn-sm text-white w-100 mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="Admin">
                                    <i class="fa fa-power-off fa-sm"></i> Deactivate
                                </button>
                            </form>
                        @else
                            <form id="activateAdminForm"  action="{{ route('admin.activate', $admin->id) }}" method="POST" class="d-inline" style="display:inline;">
                                @csrf
                                <button id="activateAdminModal" type="button" title="Decline" class="btn btn-success btn-sm text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="Admin">
                                    <i class="fa fa-power-off fa-sm"></i> Activate
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<!-- Add Admin Modal -->
<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Profile Picture --}}
                    <div class="form-group my-3">
                        <label for="profile_pic">Profile Picture</label>
                        <input
                            type="file"
                            class="form-control @error('profile_pic') is-invalid @enderror"
                            id="profile_pic"
                            name="profile_pic"
                            required
                        >
                        @error('profile_pic')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Username --}}
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}"
                            required
                        >
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >
                            <button class="btn btn-outline-secondary" type="button">
                                <i
                                    class="fa fa-eye toggle-password"
                                    data-target="password"
                                    style="cursor: pointer;"
                                ></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group mb-3">
                        <label for="confirmation_password">Confirm Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="confirmation_password"
                                id="confirmation_password"
                                class="form-control @error('confirmation_password') is-invalid @enderror"
                                required
                            >
                            <button class="btn btn-outline-secondary" type="button">
                                <i
                                    class="fa fa-eye toggle-password"
                                    data-target="confirmation_password"
                                    style="cursor: pointer;"
                                ></i>
                            </button>
                        </div>
                        @error('confirmation_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Admin Type --}}
                    <div class="form-group mb-3">
                        <label for="admin_type">Admin Type</label>
                        <select
                            name="admin_type"
                            id="admin_type"
                            class="form-control @error('admin_type') is-invalid @enderror"
                            required
                        >
                            <option value="2" {{ old('admin_type') == 2 ? 'selected' : '' }}>Assistant</option>
                            <option value="3" {{ old('admin_type') == 3 ? 'selected' : '' }}>Employee</option>
                        </select>
                        @error('admin_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Password Toggle Script --}}

</div>
</section>
