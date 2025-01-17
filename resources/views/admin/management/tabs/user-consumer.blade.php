<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="adminconsumerTable" class="table table-bordered">
              <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Profile Picture</th>
                        <th>Phone Number</th>
                        <th>Online Status</th>
                        <th>Last Online</th>
                        <th>Deactivated Date</th>
                        <th>Deactivated Status</th>
                        <th>View</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @switch($user->user_type)
                                @case(1) Consumer @break
                            @endswitch
                        </td>
                        <td>
                            @if($user->profile_pic)
                                <img src="{{ asset($user->profile_pic) }}" alt="{{ $user->username }}" width="50">
                            @else
                                No Profile Picture
                            @endif
                        </td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $user->last_online }}</td>
                        <td>{{ $user->deactivated_date }}</td>
                        <td>{{ $user->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td class="table-action-buttons">
                            <a href="{{ route('admin.management.view', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                        </td>
                        <td>
                        @if ($user->deactivated_status)
                            <form id="activateConsumerForm" action="{{ route('admin.management.reactivate', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button id="activateConsumerModal" type="button" title="Activate" class="btn btn-success text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="Consumer">
                                    <i class="fa fa-power-off fa-sm me-2"></i>Activate
                                </button>
                            </form>
                        @else
                            <form id="deactivateConsumerForm" action="{{ route('admin.management.deactivate', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button id="deactivateConsumerModal" type="button" title="Deactivate" class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="Consumer">
                                    <i class="fa fa-power-off fa-sm me-2"></i>Deactivate
                                </button>
                            </form>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

