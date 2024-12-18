<div>
    @if (session('error'))
    <div>
        <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

        <div class="popup error">
            <i class="close bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
            <div class="icon-container error-bg">
                <i class="icon bi bi-x-circle"></i>
            </div>
            <div class="container-contents">
                <h3>Oops!</h3>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

@if (session('success'))
                <div>
                    <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

                    <div class="popup success">
                        <i class="close bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                        <div class="icon-container success-bg">
                            <i class="icon bi bi-check-circle"></i>
                        </div>
                        <div class="container-contents">
                            <h3>Yay!</h3>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
@endif

@if (session('message'))
                <div>
                    <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

                    <div class="popup error">
                        <i class="close bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
                        <div class="icon-container error-bg">
                            <i class="icon bi bi-x-circle"></i>
                        </div>
                        <div class="container-contents">
                            <h3>Oops!</h3>
                            <p>{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif


</div>
