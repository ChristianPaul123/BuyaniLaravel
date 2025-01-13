<section class="min-height">
<div class="card">
    <div class="card-header">
        <h4>Admin Information</h4>
    </div>
    <div class="card-body">
        <p><strong>Username:</strong> {{ $admin->username }}</p>
        <p><strong>Email:</strong> {{ $admin->email }}</p>
        <p><strong>Admin Type:</strong> {{ $admin->admin_type }}</p>
        <p><strong>Status:</strong> {{ $admin->status ? 'Active' : 'Inactive' }}</p>
        <p><strong>Last Online:</strong> {{ $admin->last_online ? $admin->last_online : 'N/A' }}</p>
        <p><strong>Deactivation Status:</strong> {{ $admin->deactivated_status ? 'Deactivated' : 'Active' }}</p>
        <p><strong>Deactivation Date:</strong> {{ $admin->deactivated_date }}</p>
        <div>
            <img src="{{ asset($admin->profile_pic) }}" alt="Profile Picture" class="img-thumbnail" width="150">
        </div>
    </div>
</div>
</section>
