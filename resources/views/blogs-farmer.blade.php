@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'Blogs') {{-- Set the page title --}}

@push('styles')
<style>
/* Farm-themed loading screen */
#loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #f1c40f; /* Farm-like yellow */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        color: #fff;
        font-size: 2rem;
        font-weight: bold;
    }

    body {
        background-color: #f9f9f9;
    }
    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
    }
    .card-text {
        color: #666;
    }

    .modal-img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    @media (max-width: 576px) { /* Mobile devices */
        .card img.card-img-top {
            width: 100%;
            height: auto; /* Ensure proper scaling */
            display: block;
            margin-bottom: 10px; /* Add some spacing */
        }

        .card-body {
            text-align: center; /* Center-align the content */
        }

        /* Reduce card padding for better readability */
        .card {
            margin-bottom: 20px;
        }
    }
    /* Make the modal resizeable */
    .modal-sm {
        max-width: 600px;
    }
</style>
@endpush

@section('content')
 @include('user.includes.navbar-farmer')

<!-- About Us Section -->
<section class="min-height">
    {{-- <div id="loading-screen">
        🌾 Farm Loading... 🚜
    </div> --}}

    <h1 class="text-center mb-4">Our Blogs</h1>

    <div class="container my-5">
        <!-- Latest Blog -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card latest-blog-card">
                    <img
                        src="{{ asset($latestBlog->blog_pic) }}"
                        class="card-img-top blog-img"
                        alt="Latest Blog Image"
                        data-bs-toggle="modal"
                        data-bs-target="#blogModal"
                        data-title="{{ $latestBlog->blog_title }}"
                        data-author="{{ $latestBlog->admin->username }}"
                        data-date="{{ $latestBlog->created_at }}"
                        data-info="{{ $latestBlog->blog_info }}"
                        data-img="{{ asset($latestBlog->blog_pic) }}"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $latestBlog->blog_title }}</h5>
                        <p class="card-text">{{ Str::limit($latestBlog->blog_info, 100) }}</p>
                        <p class="text-muted">{{ $latestBlog->admin->username}} | {{ \Carbon\Carbon::parse($latestBlog->created_at)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="row g-3">
            @foreach($blogs as $blog)
            <div class="col-md-4 col-6">
                <div class="card">
                    <img
                        src="{{ asset($blog->blog_pic) }}"
                        class="card-img-top blog-img"
                        alt="Blog Image"
                        data-bs-toggle="modal"
                        data-bs-target="#blogModal"
                        data-title="{{ $blog->blog_title }}"
                        data-author="{{ $blog->admin->username }}"
                        data-date="{{ $blog->created_at }}"
                        data-info="{{ $blog->blog_info }}"
                        data-img="{{ asset($blog->blog_pic) }}"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->blog_title }}</h5>
                        <p class="text-muted">{{ $blog->admin->username }} | {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel">Blog Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImg" src="" alt="Blog Image" class="modal-img">
                    <h5 id="modalTitle"></h5>
                    <p id="modalAuthor"></p>
                    <p id="modalDate"></p>
                    <p id="modalInfo"></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Show loading screen until the page fully loads
    window.addEventListener('load', function() {
        document.getElementById('loading-screen').style.display = 'none';
    });

    // Populate modal with data on image click
    document.querySelectorAll('.blog-img').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('modalImg').src = img.dataset.img;
            document.getElementById('modalTitle').textContent = img.dataset.title;
            document.getElementById('modalAuthor').textContent = "Author: " + img.dataset.author;
            document.getElementById('modalDate').textContent = "Date: " + img.dataset.date;
            document.getElementById('modalInfo').textContent = img.dataset.info;
        });
    });
</script>
@endsection

