<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Product</title>
    <link rel="icon" type="image/png" href="../img/logo1.svg">
    @include('layouts.head')
    @include('admin.styles.admin_styles')

</head>
<body class="body">
@auth('admin')
    @include('admin.includes.navbar')


     <div class="container-fluid">
        <div class="row">


        @include('admin.includes.sidebar')

            <section class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Product</h1>
                </div>

            <!--Add the more part here
            EX: just add a div
            -->
            <div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" class="form-control" id="product_price" name="product_price" required>
                            </div>
                            <div class="form-group">
                                <label for="product_details">Product Details</label>
                                <input type="text" class="form-control" id="product_details" name="product_details" required>
                            </div>
                            <div class="form-group">
                                <label for="product_status">Product Status</label>
                                <input type="text" class="form-control" id="product_status" name="product_status" required>
                            </div>
                            <div class="form-group">
                                <label for="product_kg">Product Kg</label>
                                <input type="number" class="form-control" id="product_kg" name="product_kg" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <input type="text" class="form-control" id="category_id" name="category_id" required>
                            </div>
                            <div class="form-group">
                                <label for="sub_category_id">Sub Category</label>
                                <input type="text" class="form-control" id="sub_category_id" name="sub_category_id" required>
                            </div>
                            <div class="d-flex ">
                                <button type="submit" class="btn btn-block my-3 px-4" style="background-color: #06ff02;">Submit</button>
                            </div>
            </div>
        </section>

    </div>
</div>
 <form action="{{ route('admin.logout') }}" method="POST">
    {{-- @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
 <h1>Welcome to Admin Dashboard, {{ auth()->guard('admin')->user()->username }}</h1> --}}
 @session('message')


@endsession


@else
        <p>not logged in</p>
        @session('message')
        <div class="success-message">
            {{ session('message') }}
        </div>
        @endsession
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
