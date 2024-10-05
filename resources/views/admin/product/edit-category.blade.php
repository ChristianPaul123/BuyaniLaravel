<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Category | Edit</title>
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
                    <h1 class="h2">Category</h1>
                </div>

            <!--Add the more part here
            EX: just add a div
            -->
            <div class="card my-3">
                <div class="card-header">
                    <h3 class="card-title"> Edit Category</h3>
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
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name"  value="{{$category->category_name}}" required>
                        </div>
                        <div class="d-flex ">
                            <button type="submit" class="btn btn-block my-3 px-4" style="background-color: #06ff02;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
 <form action="{{ route('admin.logout') }}" method="POST">

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
