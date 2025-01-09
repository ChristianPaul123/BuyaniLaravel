<div>
    {{-- <div class="row voting-poll mt-4">
        <h3 class="mb-3 text-center">Product Voting Poll</h3>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row max-height">
                @forelse ($suggestedProducts as $product)
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4" wire:key="{{ $product->id }}">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center gap-3">
                            <div class="product-image">
                                <img
                                    src="{{ $product->suggest_image ? asset('storage/'.$product->suggest_image) : asset('img/logo1.svg') }}"
                                    alt="{{ $product->suggest_name }}"
                                    class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                            <div class="details flex-grow-1">
                                <h5 class="card-title mb-2 font-weight-bold" style="font-size: 18px; color: #333;">{{ $product->suggest_name }}</h5>
                                <p class="card-text mb-0" style="color: #777; font-size: 14px;">
                                    Requested by: <span style="font-weight: 500;">{{ $product->user->username }}</span>
                                </p>
                            </div>
                            <div class="actions d-flex align-items-center gap-2">
                                <button
                                    wire:click="toggleVote({{ $product->id }})"
                                    class="btn btn-sm"
                                    style="border-radius: 20px; padding: 5px 15px; font-size: 14px;
                                    background-color: {{ $product->votedProducts->isNotEmpty() ? '#28a745' : '#ccc' }};
                                    color: {{ $product->votedProducts->isNotEmpty() ? '#fff' : '#000' }};">
                                    👍
                                </button>

                                <button
                                    class="btn btn-sm"
                                    style="border-radius: 20px; padding: 5px 15px; font-size: 14px;">
                                    👍 {{ $product->total_vote_count }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center mt-5" style="color: #777; font-size: 16px; font-weight: 500;">There are no voted products yet. Be the first one!</p>
                @endforelse
            </div>
        </div>
    </div> --}}

        <!-- Section: Voting Poll -->
        <div class="row voting-poll mt-4">
            <h3 class="mb-3 text-center">Product Voting Poll</h3>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row max-height">
                    @forelse ($suggestedProducts as $product)
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4" wire:key="{{ $product->id }}">
                            <div class="card shadow-sm border-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <!-- Rank Section -->
                                        <div class="rank d-flex align-items-center justify-content-center"
                                        style="width: 30px; height: 30px; border-radius: 50%; background-color: #2d920b; font-weight: bold; color: #333; font-size: 14px;">
                                        <p style="font-size: 20px; font-weight: bold; color: #fff; text-align: center; margin-bottom: 0;"> {{ $loop->iteration }} </p>
                                        </div>
                                    <div class="product-image">
                                        <img
                                            src="{{ $product->suggest_image ? asset('storage/'.$product->suggest_image) : asset('img/logo1.svg') }}"
                                            alt="{{ $product->suggest_name }}"
                                            class="rounded-circle"
                                            style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div class="details flex-grow-1">
                                        <h5 class="card-title mb-2 font-weight-bold" style="font-size: 18px; color: #333;">
                                            {{ $product->suggest_name }}
                                        </h5>
                                        <p><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($product->suggest_description, 50, '...') }}</p>
                                        <p class="card-text mb-0" style="color: #777; font-size: 14px;">
                                            Requested by:
                                            <span style="font-weight: 500;">
                                                {{ $product->user->username }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="actions d-flex align-items-center gap-2">
                                        <button
                                            wire:click="toggleVote({{ $product->id }})"
                                            class="btn btn-sm"
                                            style="border-radius: 20px; padding: 5px 15px; font-size: 14px;
                                                background-color: {{ $product->votedProducts->isNotEmpty() ? '#28a745' : '#ccc' }};
                                                color: {{ $product->votedProducts->isNotEmpty() ? '#fff' : '#000' }};"
                                        >👍  {{ $product->total_vote_count }}</button>

                                        <!-- Modal trigger button for details -->
                                        <button
                                            class="btn btn-primary btn-sm"
                                            wire:click="showProduct({{ $product->id }})"
                                        >
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center mt-5" style="color: #777; font-size: 16px; font-weight: 500;">
                            There are no voted products yet. Be the first one!
                        </p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Modal for viewing product details -->
        <div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true"
             wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    @if($selectedProduct)
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img
                                src="{{ $selectedProduct->suggest_image ? asset('storage/'.$selectedProduct->suggest_image) : asset('img/logo1.svg') }}"
                                class="img-fluid mb-3"
                                style="max-height: 200px; object-fit: cover;"
                            >
                            <h6 class="modal-title"><strong>Product Name: </strong>{{ $selectedProduct->suggest_name }}</h6>
                            <p><strong>Description:</strong> {{ $selectedProduct->suggest_description }}</p>
                            <p class="card-text mb-0" style="color: #777; font-size: 14px;">Created Date: {{ $selectedProduct->created_at->format('F j, Y') }}</p>
                            <p><strong>Status:</strong>
                                @if ($selectedProduct->is_accepted == 1)
                                    <span class="text-success">Accepted</span>
                                @elseif ($selectedProduct->is_accepted == 2)
                                    <span class="text-danger">Declined</span>
                                @else
                                    <span class="text-warning">Pending</span>
                                @endif
                            </p>
                            @if ($selectedProduct->is_accepted == 1)
                            <p><strong>Current Votes:</strong> {{ $selectedProduct->total_vote_count }}</p>
                            <p><strong>Accepted By:</strong> {{ $selectedProduct->verified_by }}</p>
                            @elseif ($selectedProduct->is_accepted == 2)
                            <p><strong>Rejected By:</strong> {{ $selectedProduct->verified_by }}</p>
                            @else
                            <p><strong>Waiting for Approval!</strong></p>
                            @endif
                        </div>
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

     <!-- Section: My Suggestions -->
     <div class="row voting-poll my-4">
        <h3 class="mb-3 text-center">My Suggested Products</h3>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row max-height">
                @forelse ($mySuggestions as $myProduct)
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4" wire:key="my-suggestion-{{ $myProduct->id }}">
                        <div class="card shadow-sm border-0">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="product-image">
                                    <img
                                        src="{{ $myProduct->suggest_image ? asset('storage/'.$myProduct->suggest_image) : asset('img/logo1.svg') }}"
                                        alt="{{ $myProduct->suggest_name }}"
                                        class="rounded-circle"
                                        style="width: 70px; height: 70px; object-fit: cover;"
                                    >
                                </div>
                                <div class="details flex-grow-1">
                                    <h5 class="card-title mb-2 font-weight-bold" style="font-size: 18px; color: #333;">
                                        {{ $myProduct->suggest_name }}
                                    </h5>

                                    <p class="card-text mb-0" style="color: #777; font-size: 14px;">
                                        Status:
                                        @if ($myProduct->is_accepted == 1)
                                            <span class="text-success font-weight-bold">Accepted</span>
                                        @elseif ($myProduct->is_accepted == 2)
                                            <span class="text-danger font-weight-bold">Declined</span>
                                        @else
                                            <span class="text-warning font-weight-bold">Pending</span>
                                        @endif
                                    </p>
                                    <p class="card-text mb-0" style="color: #777; font-size: 14px;">Created Date: {{ $myProduct->created_at->format('F j, Y') }}</p>
                                </div>
                                <!-- Modal trigger button for details -->
                                <button
                                    class="btn btn-primary btn-sm"
                                    wire:click="showProduct({{ $myProduct->id }})"
                                >
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center mt-5" style="color: #777; font-size: 16px; font-weight: 500;">
                        You have not created any product suggestions yet.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-12 " style="background-color: white;">
        <p class="text-left mt-5" style="color: #000000; font-size: 16px; font-weight: 500;">
           <strong> You have: </strong> {{ $maxVoteCount }} remaining votes this month <br>
            <strong> You have: </strong> {{ $maxSuggestions }} remaining suggestions this month
        </p>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('show-modal', (modalId) => {
            let modalEl = document.querySelector(`#${modalId}`);
            let modal   = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        });
    });
</script>

@endscript
