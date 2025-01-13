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
                        <td>{{ $rating->product->product_name ?? 'N/A' }}</td>
                        <td>{{ $rating->user->username ?? 'N/A' }}</td>
                        <td>{{ $rating->rating }}</td>
                        <td>{{ $rating->comment }}</td>
                        <td>{{ $rating->deactivated_date ? $rating->deactivated_date->format('M d, Y h:i A') : 'N/A' }}</td>
                        <td>{{ $rating->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            @if ($rating->deactivated_status)
                                <form id="activateProductReviewForm" action="{{ route('admin.reviews.productrating.activate', $rating->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="activateProductReviewModal" type="button" title="Activate" class="btn btn-success text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="ProductReview">
                                        <i class="fa fa-power-off fa-sm me-2"></i>Activate
                                    </button>
                                </form>
                            @else
                                <form id="deactivateProductReviewForm" action="{{ route('admin.reviews.productrating.deactivate', $rating->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="deactivateProductReviewModal" type="button" title="Deactivate" class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="ProductReview">
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
