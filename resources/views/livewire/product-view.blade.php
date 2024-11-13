<style>
    .card {
        width: 100%;
        margin-bottom: 1rem;
    }

    .row {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .pagination {
        justify-content: flex-end;
    }
</style>


<div class="container container-fluid" style="background-color: rgb(195, 184, 184)">
    <section>
        <h3 class='text-center mt-2'>{{ $product->product_name }}</h3>
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="alert alert-success mx-3 my-2 px-3 py-2">
                <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" style="max-width: 80%; height: auto;">
            </div>

            <div class="col-md-6">
                <div class="row md-2 my-2">
                    <p class="h5 text-center">Product Information</p>
                    <div class="col">{{ $product->product_details }}</div>
                </div>
                <div class="row md-2 my-3">
                    <div class="col">Tags: {{ $product->category->category_name }}, {{ $product->subcategory->sub_category_name }}</div>
                </div>
                <div class="row md-2 mb-3">
                    <div class="col">In Store: {{ $product->status_label }}</div>
                </div>

                <div class="row md-2">
                    <div class="col">Product Specification:</div>
                </div>

                <div class="row">
                    @foreach ($specifications as $specification)
                    <div class="col-md-5 m-1">
                        <div class="card"  style="width: auto";>
                            <div class="card-header text-center">
                                <h6 class="mb-0">{{ $specification->specification_name }}</h6>
                            </div>
                            {{-- <img src="{{ asset($product->product_pic) }}" class="card-img-top" alt="products {{ $product->product_name }}"> --}}
                            <div class="card-body">
                                <p class="card-text">Price: ₱{{ $specification->product_price }}</p>
                            </div>
                            <form wire:submit.prevent="addToCart({{ $specification->id }})">
                                <div class="row d-flex align-items-center justify-content-center">
                                    <div class="col-8 align-items-center">
                                        <input type="hidden" wire:model="product_status" value="{{ $specification->product->product_status }}">
                                        @error('product_status') <span class="text-warning">{{ $message }}</span> @enderror
                                        <input type="hidden" id="quantity" class="form-control" wire:model="quantities"  min="1">
                                        @error('quantities') <span class="text-warning">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-12 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>

      {{-- Placeholder for Product Reviews --}}
        <section>
@livewire('product-rating-system',['productId' => $product->id])
        </section>
</div>
