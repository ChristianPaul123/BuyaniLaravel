@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'Product Catalog') <!-- Define the title for this page -->

@push('styles')
    <style>
        .navbar-category {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #175593;
            border-bottom: 1px solid #ddd;
        }

        .navbar-nav .nav-link {
            color: #333;
        }

        .navbar-nav .nav-link.active {
            font-weight: bold;
        }

        .card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 0.95rem;
            padding: 0.5rem;
        }

        .card-body {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }

        .input-group button {
            font-size: 0.8rem;
            height: 30px;
        }

        .input-group input {
            font-size: 0.8rem;
            height: 30px;
            width: 50px;
            padding: 0 0.25rem;
        }

        button.btn-primary {
            transition: all 0.3s ease;
        }

        button.btn-primary:hover {
            background-color: #45c657;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .star-rating .fa {
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating .fa-star {
            color: #FFD700;
        }

        .star-rating .fa-star-o {
            color: #d6e80c;
        }

        .product-gallery {
            display: flex;
        }

        .product-gallery-thumblist {
            margin-left: -0.5rem;
        }

        .product-gallery-thumblist-item {
            display: block;
            position: relative;
            width: 5rem;
            height: 5rem;
            margin: 0.625rem;
            transition: border-color 0.2s ease-in-out;
            border: 1px solid #e3e9ef;
            border-radius: 0.3125rem;
            text-decoration: none !important;
            overflow: hidden;
        }

        .product-gallery-thumblist-item>img {
            display: block;
            width: 100%;
            transition: opacity 0.2s ease-in-out;
            opacity: 0.6;
        }

        .product-gallery-thumblist-item .product-gallery-thumblist-item-text {
            position: absolute;
            top: 50%;
            width: 100%;
            padding: 0.25rem;
            transform: translateY(-50%);
            color: #4b566b;
            font-size: 0.875rem;
            text-align: center;
        }

        .product-gallery-thumblist-item .product-gallery-thumblist-item-text>i {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 1.5em;
        }

        .product-gallery-thumblist-item:hover {
            border-color: #c9d5e0;
        }

        .product-gallery-thumblist-item:hover>img {
            opacity: 1;
        }

        .product-gallery-thumblist-item.active {
            border-color: var(--cz-primary);
        }

        .product-gallery-thumblist-item.active>img {
            opacity: 1;
        }

        .product-gallery-preview {
            position: relative;
            width: 100%;
            margin-top: 0.625rem;
        }

        @media (min-width: 500px) {
            .product-gallery-preview {
                margin-left: 0.625rem;
            }
        }

        .product-gallery-preview-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
            z-index: 1;
        }

        .product-gallery-preview-item>img {
            display: block;
            width: 100%;
        }

        .product-gallery-preview-item.active {
            position: relative;
            opacity: 1;
            z-index: 10;
        }

        .product-gallery-preview-item:hover {
            cursor: crosshair;
        }

        @media (max-width: 499.98px) {
            .product-gallery {
                display: block;
            }

            .product-gallery-thumblist {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-right: -1rem;
                margin-left: -1rem;
                padding-top: 1rem;
            }

            .product-gallery-thumblist-item {
                margin: 0.3125rem;
            }
        }
    </style>
@endpush

@section('x-content')
    @include('user.includes.navbar-consumer')
    <div class="main-content-wrapper">
        <!-- All your main page content goes here -->
        @livewire('product-view', ['productId' => $product->id])
    </div>

@endsection

@section('scripts')

@endsection


    <script>
        var productGallery = function() {
            var gallery = document.querySelectorAll('.product-gallery');
            if (gallery.length) {
                var _loop3 = function _loop3(i) {
                    var thumbnails = gallery[i].querySelectorAll(
                        '.product-gallery-thumblist-item:not(.video-item)'),
                        previews = gallery[i].querySelectorAll('.product-gallery-preview-item'),
                        videos = gallery[i].querySelectorAll('.product-gallery-thumblist-item.video-item');
                    for (var n = 0; n < thumbnails.length; n++) {
                        thumbnails[n].addEventListener('click', changePreview);
                    }

                    // Changer preview function
                    function changePreview(e) {
                        e.preventDefault();
                        for (var _i = 0; _i < thumbnails.length; _i++) {
                            previews[_i].classList.remove('active');
                            thumbnails[_i].classList.remove('active');
                        }
                        this.classList.add('active');
                        gallery[i].querySelector(this.getAttribute('href')).classList.add('active');
                    }
                };
                for (var i = 0; i < gallery.length; i++) {
                    _loop3(i);
                }
            }
        }();
    </script>
@endsection
