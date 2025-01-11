<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="managesuggestionsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Suggested By</th>
                        <th>Suggestion Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Verified By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingproductSuggestions as $suggestion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suggestion->user->username ?? 'N/A' }}</td>
                        <td>{{ $suggestion->suggest_name }}</td>
                        <td>{{ $suggestion->suggest_description }}</td>
                        <td>
                            @if ($suggestion->suggest_image)
                                <img src="{{ $suggestion->suggest_image ? asset('storage/'.$suggestion->suggest_image) : asset('img/logo1.svg') }}"  alt="Suggested Image" class="img-thumbnail" width="80">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $suggestion->is_accepted ? 'Accepted' : 'Pending' }}</td>
                        <td>{{ $suggestion->admin->name ?? 'N/A' }}</td>
                        <td>
                            {{-- Accept Suggestion --}}
                            @if (!$suggestion->is_accepted)
                                <form action="{{ route('admin.voted-products.suggestions.accept', $suggestion->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button title="Accept" style="background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="fa fa-check" style="color:green;"></i>
                                    </button>
                                </form>
                            @endif

                            {{-- Reject Suggestion --}}
                            <form action="{{ route('admin.voted-products.suggestions.reject', $suggestion->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button title="Reject" style="background:none;border:none;padding:0;cursor:pointer;">
                                    <i class="fa fa-times" style="color:red;"></i>
                                </button>
                            </form>

                            {{-- View Details --}}
                            <a href="{{ route('admin.voted-products.suggestions.view', $suggestion->id) }}" title="View Details" style="margin-left: 5px;">
                                <i class="fa fa-eye" style="color:blue;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
