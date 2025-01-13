<div class="container mt-4 min-vh-100">
    <!-- Rating Summary -->
    <div class="mt-4">
        <h5>Customer Reviews</h5>

        <!-- Overall Star Rating -->
        <p class="text-warning h5 mb-1">
            @if($averageRating > 0)
                {!! str_repeat('&#9733;', floor($averageRating)) !!}{{-- Full stars --}}
                @if(floor($averageRating) < $averageRating)&#189;{{-- Half star --}}
                @endif
            @else
                &#9734;&#9734;&#9734;&#9734;&#9734; {{-- Empty stars if no rating --}}
            @endif
        </p>

        <!-- Rating Details -->
        <p class="small text-muted">
            {{ number_format($averageRating, 1) }} based on {{ $ratings->total() }} reviews
        </p>
        <p class="small text-success">
            {{ $ratings->total() > 0 ? number_format(($ratings->where('rating', '>=', 4)->count() / $ratings->total()) * 100, 0) : 0 }}% of respondents would recommend this product
        </p>
    </div>

    <div class="row mb-4" style="background-color: rgb(245, 245, 245); border-radius: 8px; padding: 20px;">
        <!-- Average Rating -->
        <div class="col-md-4 text-center">
            <h1 class="display-4" style="color: #4CAF50;">{{ $averageRating }}</h1>
            <p style="color: #777;">Average Rating</p>
            <p style="font-size: 1.5rem; color: #FFD700;">
                {{ str_repeat('★', round($averageRating)) }}{{ str_repeat('☆', 5 - round($averageRating)) }}
            </p>
        </div>

        <!-- Rating Breakdown -->
        <div class="col-md-8">
            <h5 style="color: #4CAF50;">Product Rating Summary</h5>
            @for ($i = 5; $i >= 1; $i--)
                <div class="d-flex align-items-center mb-2">
                    <span class="mr-3" style="width: 70px; text-align: left; color: #555;">{{ $i }} Stars</span>
                    <div class="progress flex-grow-1" style="height: 10px; background-color: #ddd;">
                        <div class="progress-bar" role="progressbar" style="width: {{ isset($ratingBreakdown[$i]) ? ($ratingBreakdown[$i] / array_sum($ratingBreakdown)) * 100 : 0 }}%; background-color: #4CAF50;" aria-valuenow="{{ $ratingBreakdown[$i] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="ml-3" style="width: 30px; text-align: right; color: #555;">{{ $ratingBreakdown[$i] ?? 0 }}</span>
                </div>
            @endfor
        </div>
    </div>

    <!-- Filter Reviews -->
    <div class="mb-4 row align-items-center" style="background-color: rgb(245, 245, 245); border-radius: 8px; padding: 20px;">
        <!-- Label -->
        <div class="col-3 col-md-2">
            <label for="ratingFilter" class="form-label" style="color: #4CAF50; font-weight: bold; font-size: 1rem;">
                Filter by Rating:
            </label>
        </div>

        <!-- Dropdown -->
        <div class="col-6 col-md-8">
            <select wire:model.live="ratingValue" id="ratingFilter" class="form-select"
                style="border-radius: 8px; padding: 10px; font-size: 1rem; border: 1px solid #ddd; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                <option value="0">All Ratings</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
        </div>
    </div>


    <!-- Reviews -->
    <div class="ratings-list mt-4" style="background-color: rgb(245, 245, 245); border-radius: 8px; padding: 20px; margin: 20px 0px;">
        <div wire:loading>
            <p>Loading ratings...</p>
        </div>
        <div wire:loading.remove>
            @forelse ($ratings as $rating)
                <div class="card mb-3" style="border-radius: 8px; border: none; background-color: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body d-flex align-items-start">
                        <!-- Profile Picture -->
                        <img src="{{ $rating->user->profile_pic ? asset($rating->user->profile_pic) : asset('img/title/consumer.png') }}" alt="Profile Picture"
                             class="rounded-circle mr-3" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #ddd;">

                        <!-- Review Details -->
                        <div>
                            <strong style="color: #4CAF50;">{{ $rating->user->username }}</strong>
                            <p class="text-muted" style="font-size: 0.85rem;">{{ $rating->created_at->format('M d, Y') }}</p>
                            <p>
                                <span style="color: #FFD700;">{{ str_repeat('★', $rating->rating) }}{{ str_repeat('☆', 5 - $rating->rating) }}</span>
                            </p>
                            <p style="color: #555;">{{ $rating->comment }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center" style="color: #777;">No reviews match the selected filter.</p>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            <div wire:loading>
                <p>Loading...</p>
            </div>
            <div wire:loading.remove>
                {{ $ratings->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    <!-- Add a Review -->
    @auth('user')
    <div class="add-rating mt-4">
        <h6 style="color: #4CAF50;">Add Your Rating</h6>

        <!-- Star Rating -->
        <div class="mb-3">
            <label class="form-label" style="color: #555;">Rating:</label>
            <div class="star-rating" style="font-size: 2rem; color: #FFD700;">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="{{ $i <= $temporaryRating ? 'fa-solid fa-star' : 'fa-regular fa-star' }}"
                       wire:click="$set('temporaryRating', {{ $i }})"
                       style="cursor: pointer;"></i>
                @endfor
            </div>
        </div>

        <!-- Comment Section -->
        <div class="mb-3">
            <label for="comment" class="form-label" style="color: #555;">Comment:</label>
            <textarea wire:model="comment" id="comment" rows="3" class="form-control" style="border-radius: 6px;"></textarea>
        </div>

        <!-- Submit Button -->
        <button wire:click="submitRating" class="btn btn-primary btn-block mt-2 mb-3"
            style="background-color: #4CAF50; border: none; font-size: 1rem; font-weight: bold; color: white; border-radius: 8px;">
            Submit
        </button>
    </div>
    @else
        <p class="text-center" style="color: #777;">Please <a href="{{ route('user.index') }}" style="color: #4CAF50;">log in</a> to leave a rating.</p>
    @endauth
</div>
