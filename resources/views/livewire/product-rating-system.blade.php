<div class="container mt-4" style="background-color: rgb(245, 245, 245); border-radius: 8px; padding: 20px;">
    <!-- Rating Summary -->
    <div class="row mb-4">
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
            <h5 style="color: #4CAF50;">Audience Rating Summary</h5>
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
    <div class="mb-4 row align-items-center">
        <!-- Label -->
        <div class="col-3 col-md-2">
            <label for="ratingFilter" class="form-label" style="color: #4CAF50; font-weight: bold; font-size: 1rem;">
                Filter by Rating:
            </label>
        </div>

        <!-- Dropdown -->
        <div class="col-6 col-md-8">
            <select wire:model="ratingValue" id="ratingFilter" class="form-select"
                style="border-radius: 8px; padding: 10px; font-size: 1rem; border: 1px solid #ddd; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                <option value="0">All Ratings</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
        </div>

        <!-- Button -->
        <div class="col-3 col-md-2 text-end">
            <button wire:click="applyRatingFilter" class="btn btn-primary"
                style="background-color: #4CAF50; border: none; padding: 10px 15px; border-radius: 8px; font-size: 1rem; font-weight: bold; color: white; width: 100%;">
                Confirm
            </button>
        </div>
    </div>


    <!-- Reviews -->
    <div class="ratings-list mt-4">
        <div wire:loading>
            <p>Loading ratings...</p>
        </div>
        <div wire:loading.remove>
            @forelse ($ratings as $rating)
                <div class="card mb-3" style="border-radius: 8px; border: none; background-color: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body d-flex align-items-start">
                        <!-- Profile Picture -->
                        <img src="{{ $rating->user->profile_pic ? Storage::url($rating->user->profile_pic) : asset('images/placeholder.png') }}" alt="Profile Picture"
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
            {{ $ratings->links() }}
        </div>
    </div>

    <!-- Add a Review -->
    @auth('user')
        <div class="add-rating mt-4">
            <h6 style="color: #4CAF50;">Add Your Rating</h6>
            <div class="mb-3">
                <label for="newRating" class="form-label" style="color: #555;">Rating:</label>
                <select wire:model="newRating" id="newRating" class="form-select" style="border-radius: 6px;">
                    <option value="0">Select Rating</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label" style="color: #555;">Comment:</label>
                <textarea wire:model="comment" id="comment" rows="3" class="form-control" style="border-radius: 6px;"></textarea>
            </div>

            <button wire:click="addRating" class="btn btn-primary btn-block mt-"
            style="background-color: #4CAF50; border: none; font-size: 1rem; font-weight: bold; color: white; border-radius: 8px;">
            Submit
        </button>
    </div>
    @else
        <p>Please <a href="{{ route('user.index') }}" style="color: #4CAF50;">log in</a> to leave a rating.</p>
    @endauth
</div>
