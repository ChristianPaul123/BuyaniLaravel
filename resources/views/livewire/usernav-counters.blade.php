<div>
    <ul class="nav justify-content-center">
        <!-- Cart Icon -->
        <li class="nav-item px-1 position-relative">
            <a class="nav-link @if(request()->is('user/consumer/cart')) active @endif" href="/user/consumer/cart" data-page="cart">
                <i class="fas fa-shopping-basket" style="font-size: 25px;"></i>
                @if($cartCount > 0)
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                    {{ $cartCount }}
                </span>
                @endif
            </a>
        </li>

        <!-- Favorites Icon -->
        <li class="nav-item px-1 position-relative">
            <a class="nav-link @if(request()->is('user/consumer/favorites')) active @endif" href="/user/consumer/favorites" data-page="favorites">
                <i class="fas fa-heart" style="font-size: 25px;"></i>
                @if($favoritesCount > 0)
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                    {{ $favoritesCount }}
                </span>
                @endif
            </a>
        </li>
    </ul>
</div>
