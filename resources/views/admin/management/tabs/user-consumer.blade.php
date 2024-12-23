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
                        <form action="{{ route('admin.management.reactivate', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button title="Activate" style="background:none;border:none;padding:0;cursor:pointer;">
                                <i class="fa fa-power-off" style="color:green;"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.management.deactivate', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button title="Deactivate" style="background:none;border:none;padding:0;cursor:pointer;">
                                <i class="fa fa-power-off" style="color:red;"></i>
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

<tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->username }}</a></td>
            <td class="text-right">
                <div class="actions">
                    <button id="suspendd" data-toggle="modal"
                        data-target="#demoModal{{ $user->id }}"
                        class="btn btn-sm bg-danger-light">TEST</button>
                </div>
            </td>
             <!-- Modal Example Start-->
             <div class="modal fade" id="demoModal{{ $user->id }}" value="{{$user->id}}" tabindex="-1" role="dialog" aria- labelledby="demoModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="demoModalLabel{{ $user->id }}">
                                Reason to Suspend This User</h5>
                            <button type="button" class="close"
                                data-dismiss="modal" aria- label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-10">
                            <textarea rows="5" cols="15" class="form-control summernote" placeholder="Compose mail here" name="details"
                                value="details" id="details" required></textarea>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            {{-- <a href="#"
                                class="btn btn-primary"><i
                                    class="fa fa-send m-r-5"></i><span>Send</span></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        <!-- Modal Example End-->
        </tr>
    @endforeach
</tbody>

