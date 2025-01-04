<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="productreviewTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Username</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Deactivated Date</th>
                        <th>Deactivated Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productRatings as $rating)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rating->product->name ?? 'N/A' }}</td>
                        <td>{{ $rating->user->username ?? 'N/A' }}</td>
                        <td>{{ $rating->rating }}</td>
                        <td>{{ $rating->comment }}</td>
                        <td>{{ $rating->deactivated_date }}</td>
                        <td>{{ $rating->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            @if ($rating->deactivated_status)
                                <form action="{{ route('productRating.reactivate', $rating->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button title="Activate" style="background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="fa fa-power-off" style="color:green;"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('productRating.deactivate', $rating->id) }}" method="POST" class="d-inline">
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
