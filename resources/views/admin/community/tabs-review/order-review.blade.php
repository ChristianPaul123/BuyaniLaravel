<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="orderreviewTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Comment</th>
                        <th>Reviewed By</th>
                        <th>Delivery Rating</th>
                        <th>Rating</th>
                        <th>Deactivated Date</th>
                        <th>Deactivated Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderRatings as $rating)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rating->order_id }}</td>
                        <td>{{ $rating->user_id }}</td>
                        <td>{{ $rating->comment }}</td>
                        <td>{{ $rating->reviewed_by }}</td>
                        <td>{{ $rating->delivery_rating }}</td>
                        <td>{{ $rating->rating }}</td>
                        <td>{{ $rating->deactivated_date }}</td>
                        <td>{{ $rating->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            @if ($rating->deactivated_status)
                                <form action="{{ route('orderRating.reactivate', $rating->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button title="Activate" style="background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="fa fa-power-off" style="color:green;"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('orderRating.deactivate', $rating->id) }}" method="POST" class="d-inline">
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
