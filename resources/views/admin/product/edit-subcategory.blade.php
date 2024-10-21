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
                <h1 class="h2">SubCategory</h1>
            </div>

        <!--Add the more part here
        EX: just add a div
        -->
        <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <button type="button" class="btn btn-primary" onclick="window.history.back()"> &#9754; Back to previous</button>
        </div>
        <div class="card my-3">
            <div class="card-header">
                <h3 class="card-title"> Edit SubCategory</h3>
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
                <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value=" {{$subcategory->category_id}}" selected>{{$subcategory->category->category_name}}</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_category_name">Category Name</label>
                        <input type="text" class="form-control" id="sub_category_name" name="sub_category_name"  value="{{$category->category_name}}" required>
                    </div>
                    <div class="d-flex ">

                        <button type="submit" class="btn btn-block my-3 px-4 btn-success" >Submit</button>
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
