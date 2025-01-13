<section class="min-height">
<div class="card">
    <div class="card-header">
        <h4>Admin Information</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 25%;">Username:</th>
                    <td>{{ $admin->username }}</td>
                </tr>
                <tr>
                    <th style="width: 25%;">Email:</th>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <th style="width: 25%;">Admin Type:</th>
                    <td>{{ $admin->admin_type }}</td>
                </tr>
                <tr>
                    <th style="width: 25%;">Status:</th>
                    <td>{{ $admin->status ? 'Active' : 'Inactive' }}</td>
                </tr>
                <tr>
                    <th style="width: 25%;">Last Online:</th>
                    <td>{{ $admin->last_online ? $admin->last_online : 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="width: 25%;">Deactivation Status:</th>
                    <td>{{ $admin->deactivated_status ? 'Deactivated' : 'Active' }}</td>
                </tr>
                <tr>
                    <th style="width: 25%;">Deactivation Date:</th>
                    <td>{{ $admin->deactivated_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


</section>


{{-- <div>
    <img src="{{ asset($admin->profile_pic) }}" alt="Profile Picture" class="img-thumbnail" width="150">
</div> --}}
