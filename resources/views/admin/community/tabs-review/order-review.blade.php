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
                                <form id="activateOrderReviewForm" action="{{ route('admin.reviews.orderrating.activate', $rating->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="activateOrderReviewModal" type="button" title="Activate" class="btn btn-success text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="OrderReview">
                                        <i class="fa fa-power-off fa-sm me-2"></i>Activate
                                    </button>
                                </form>
                            @else
                                <form id="deactivateOrderReviewForm"  action="{{ route('admin.reviews.orderrating.deactivate', $rating->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="deactivateOrderReviewModal" type="button" title="Deactivate" class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="OrderReview">
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
