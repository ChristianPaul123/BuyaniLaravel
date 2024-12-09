<div>
    <!-- Voting Header -->
    <div class="voting-header">
        <h1>Product Voting</h1>
        <p>Vote for your favorite products this month!</p>
    </div>

    <!-- Top Voted Products Section -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <h5 class="mb-0">Top Voted Products</h5>
                </div>
                <div class="card-body chart-container">
                    <canvas id="topVotedChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Voting Poll -->
    <div class="row voting-poll mt-4">
        <h3 class="mb-3 text-center">Product Voting Poll</h3>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row max-height">
                @forelse ($suggestedProducts as $product)
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="product-image">
                                <img
                                    src="{{ $product->suggest_image ? asset('storage/'.$product->suggest_image) : asset('img/logo1.svg') }}"
                                    alt="{{ $product->suggest_name }}"
                                    class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover;"
                                >
                            </div>
                            <div class="details flex-grow-1">
                                <h5 class="card-title mb-2 font-weight-bold" style="font-size: 18px; color: #333;">{{ $product->suggest_name }}</h5>
                                <p class="card-text mb-0" style="color: #777; font-size: 14px;">
                                    Requested by: <span style="font-weight: 500;">{{ $product->user->username }}</span>
                                </p>
                            </div>
                            <div class="actions d-flex align-items-center gap-2">
                                <button
                                    class="btn btn-info btn-sm text-nowrap"
                                    style="border-radius: 20px; padding: 5px 15px; font-size: 14px;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewProductModal"
                                    onclick="populateProductModal(
                                        '{{ asset('storage/' . ($product->suggest_image ?? 'img/logo1.svg')) }}',
                                        '{{ addslashes($product->suggest_name) }}',
                                        '{{ addslashes($product->category ?? 'N/A') }}',
                                        '{{ addslashes($product->suggest_description) }}',
                                        '{{ addslashes($product->user->username) }}',
                                        '{{ $product->total_vote_count }}',
                                        '{{ $product->rank ?? 'N/A' }}',
                                        '{{ $product->created_at->format('F Y') }}'
                                    )">
                                    👁️ View
                                </button>
                                <button class="btn btn-success btn-sm" style="border-radius: 20px; padding: 5px 15px; font-size: 14px;">
                                    👍 {{ $product->total_vote_count }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center mt-5" style="color: #777; font-size: 16px; font-weight: 500;"> there is no voted products yet be the first one </p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Request Product Button -->
    <div class="request-product">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestProductModal">+ Request Product</button>
    </div>

    <!-- Request Product Modal -->
    <div class="modal fade" id="requestProductModal" tabindex="-1" aria-labelledby="requestProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="submitSuggestion">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestProductModalLabel">Request Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" wire:model="productName" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" wire:model="category" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Introduction to requested product</label>
                            <textarea class="form-control" id="description" wire:model="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Product Image</label>
                            <input type="file" class="form-control" id="image" wire:model="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductModalLabel">View Voted Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Image Section -->
                        <div class="col-md-4 product-image">
                            <img id="modalProductImage" src="" alt="Product Image" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                            <h5 id="modalProductName" class="mt-3"></h5>
                            <p id="modalProductRequestedBy" class="product-details"></p>
                            <p id="modalProductVotes" class="product-details"></p>
                            <p id="modalProductRank" class="product-details"></p>
                            <p id="modalProductDate" class="product-details"></p>
                        </div>
                        <!-- Description Section -->
                        <div class="col-md-8">
                            <h6>Category: <span id="modalProductCategory"></span></h6>
                            <h6>Introduction to requested product:</h6>
                            <p id="modalProductDescription" class="text-muted"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', () => {
            const image = button.dataset.image;
            const name = button.dataset.name;
            const category = button.dataset.category;
            const description = button.dataset.description;
            const requestedBy = button.dataset.requestedBy;
            const votes = button.dataset.votes;
            const rank = button.dataset.rank;
            const date = button.dataset.date;

            populateProductModal(image, name, category, description, requestedBy, votes, rank, date);
        });
    });
});

// function populateProductModal(image, name, category, description, requestedBy, votes, rank, date) {
//     document.getElementById('modalProductName').innerText = name || 'N/A';
//     document.getElementById('modalProductCategory').innerText = category || 'N/A';
//     document.getElementById('modalProductDescription').innerText = description || 'No description available';
//     document.getElementById('modalProductImage').src = image || '{{ asset("img/default.jpg") }}';
//     document.getElementById('modalProductRequestedBy').innerText = `Requested By: ${requestedBy || 'Unknown'}`;
//     document.getElementById('modalProductVotes').innerText = `Votes: ${votes || 0}`;
//     document.getElementById('modalProductRank').innerText = `Rank: ${rank || 'N/A'}`;
//     document.getElementById('modalProductDate').innerText = `Date: ${date || 'N/A'}`;
// }
// <script>
document.addEventListener('DOMContentLoaded', function () {
    let chart;
    const ctx = document.getElementById('topVotedChart').getContext('2d');

    Livewire.on('chartUpdated', (labels, data) => {
        if (chart) {
            chart.destroy(); // Destroy the previous chart instance
        }

        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Votes',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
});
</script>
@endscript
