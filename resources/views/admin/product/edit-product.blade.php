<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Product</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1.svg') }}">
    @include('layouts.head')
    @include('admin.styles.admin_styles')

</head>
<body class="body">
@auth('admin')
    @include('admin.includes.navbar')


     <div class="container-fluid">
        <div class="row">


        @include('admin.includes.sidebar')

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Product</h1>
                </div>

            <!--Add the more part here
            EX: just add a div
            -->
            <div class="card my-3">
                <div class="card-header">
                    <h3 class="card-title"> Edit Product: {{ $product->product_name }}</h3>
                </div>
                {{-- if there's errors --}}
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

                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"  value="{{$product->product_name}}" required>
                        </div>

                        <div class="form-group my-3">
                            <label for="product_details">Product Details</label>
                            <textarea class="form-control" style="resize: none;" id="product_details" name="product_details" rows="2">{{$product->product_details}}</textarea>
                        </div>

                        <div class="form-group my-3">
                            <label for="product_pic">Product Image</label>
                            <input type="file" class="form-control" id="product_pic" name="product_pic" value="{{$product->product_pic}}">
                        </div>

                        <div class="form-group my-3">
                            <label for="product_status">Product Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="product_status" id="product_status_available" value="1" {{ $product->product_status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="product_status_available">
                                    Available
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="product_status" id="product_status_unavailable" value="0" {{ $product->product_status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="product_status_unavailable">
                                    Out of Stock
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="product_status" id="product_status_unavailable" value="2" {{ $product->product_status == 2 ? 'checked' : '' }}>
                                <label class="form-check-label" for="product_status_unavailable">
                                    Unavailable
                                </label>
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="{{$product->category_id}}" selected>{{$product->category->category_name}}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Remember this is not sub_category_id but subcategory_Id --}}
                        <div class="form-group">
                            <label for="subcategory_id">SubCategory</label>
                            <select class="form-control" id="subcategory_id" name="subcategory_id">
                                <option value="{{$product->subcategory_id}}" selected>{{$product->subcategory->sub_category_name}}</option>
                                @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex ">
                            <button type="submit" class="btn btn-block my-3 px-4 btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@else
        <p>not logged in</p>
@endauth
@include('layouts.script')
<script>
window.addEventListener('popstate', function(event) {
    // If the user presses the back button, log them out
    window.location.href = "{{ route('admin.logout') }}";
});
</script>
</body>
</html>
