<div class="card">
    <div class="card-header">
        <h4>Admin Payments</h4>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <label class="mb-2">Current Payment Picture:</label>
                <img src="{{ asset($admin->admin_payment) }}" alt="Payment Picture"
                     class="img-thumbnail mx-auto d-block"
                     style="width: 200px; height: 200px; object-fit: cover; border: 1px solid #dee2e6;">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.payment.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="admin_payment" class="form-label">Upload New Payment Picture</label>
                        <input type="file" name="admin_payment" id="admin_payment" class="form-control" accept="image/*">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
