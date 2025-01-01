<div>
    <div class="row voting-poll mt-4">
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
    </div>
</div>
