  <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Reviews</h5>

                    <!-- Dropdown for filtering ratings -->
                    <div class="mb-3">
                        <label for="ratingFilter" class="form-label">Filter by Rating:</label>
                        <select wire:model="ratingValue" id="ratingFilter" class="form-select" wire:change="loadRatings">
                            <option value="0">All</option>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="2">2 Stars</option>
                            <option value="1">1 Star</option>
                        </select>
                    </div>

                    <!-- Display ratings or fallback message -->
                    <div class="ratings-list mt-4">
                        <div wire:loading>
                            <p>Loading ratings...</p>
                        </div>
                        <div wire:loading.remove>
                            @forelse($ratings as $rating)
                                <div class="rating-item mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                    <strong>{{ $rating->user->username }}</strong>
                                    <p class="text-muted"> {{ $rating->created_at->format('M d, Y')}} </p>
                                    <p> Rating: <span>{{ $rating->rating }} Stars</span> </p>
                                    <p>{{ $rating->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No comments yet. Be the first one to review this product!</p>
                            @endforelse
                        </div>
                    </div>

                        <!-- Add a new rating -->
                    @auth('user')
                        <div class="add-rating mt-4">
                            <h6>Add Your Rating</h6>
                            <div class="mb-3">
                                <label for="newRating" class="form-label">Rating:</label>
                                <select wire:model="newRating" id="newRating" class="form-select">
                                    <option value="0">Select Rating</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }} Stars</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment:</label>
                                <textarea wire:model="comment" id="comment" rows="3" class="form-control"></textarea>
                            </div>

                            <button wire:click="addRating" class="btn btn-primary mt-2">Submit</button>
                        </div>
                    @else
                        <p>Please <a href="{{ route('user.index') }}">log in</a> to leave a rating.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>

