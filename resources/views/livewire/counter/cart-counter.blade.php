<div>
    @if($cartCount > 0)
        <span style="height: 25px; width: 25px; display: flex; justify-content: center; align-items: center; position: absolute; color: white; margin-top: -45px; margin-left: 23px; font-size: 15px; z-index: 8888; border-radius: 5px; background-color: red; opacity: 80%;">
            {{ $cartCount }}
        </span>
    @endif
</div>
