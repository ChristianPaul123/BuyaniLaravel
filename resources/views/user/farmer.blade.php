@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'Farmer Dashboard') {{-- Set the page title --}}

@push('styles')
<style>
@keyframes fadeInDown {
    from {
        transform: translate(-50%, -55%); /* Start from above the screen */
        opacity: 0;
    }
    to {
        transform: translate(-50%, -50%); /* Center in the screen */
        opacity: 1;
    }
}

@keyframes fadeOutUp {
    from {
        transform: translate(-50%, -50%); /* Start from center */
        opacity: 1;
    }
    to {
        transform: translate(-50%, -55%); /* Move up to above the screen */
        opacity: 0;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 0.6;
    }
}

@keyframes fadeOut {
    from {
        opacity: 0.6;
    }
    to {
        opacity: 0;
    }
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 999;
    animation: fadeIn 0.2s ease-out forwards; /* Fade in animation for the overlay */
}

.overlay.hidden {
    animation: fadeOut 0.2s ease-in forwards; /* Fade out animation for the overlay */
}

.error-popup {
    width: 400px;
    background-color: #ffffff;
    color: #842029;
    border: 1px solid black;
    border-radius: 5px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    z-index: 1000;
    animation: fadeInDown 0.3s ease-out forwards; /* Slide down animation for the modal */
}

.error-popup.hidden {
    animation: fadeOutUp 0.3s ease-in forwards; /* Slide up animation for the modal */
}

.container-contents {
    padding: 20px;
}

.error-popup .error-icon {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 120px;
    background-color: #e85e6c;
    font-size: 60px;
}

button {
    background-color: #ffc107;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.error-popup button:hover {
    background-color: #e0a800;
}

.error-icon .icon {
    color: #ffffff;
}

.error-popup .bi-x-lg {
    color: #fff;
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
@endpush

@section('content')
@include('user.includes.navbar-farmer')
@if (session('message'))
<div>
    <div class="overlay" id="overlay" aria-label="Close" onclick="closePopup()"></div>

    <div class="error-popup">
        <i class="bi bi-x-lg fs-4" aria-label="Close" onclick="closePopup()"></i>
        <div class="error-icon">
            <i class="icon bi bi-x-circle"></i>
        </div>
        <div class="container-contents">
            <h3>Ooops!</h3>
            <p>{{ session('message') }}</p>
            {{-- <button onclick="">Button</button> --}}
        </div>
    </div>

</div>
@endif

         <!-- Main Page -->
    <section class="mt-5">
        @if ($isProfileIncomplete == true)
        <!-- Modal Trigger -->
        <div id="profileIncompleteModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile Incomplete</h5>
                </div>
                <div class="modal-body">
                    <p>Looks like you don't have any other info yet. Why not try editing it?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.consumer.profile.show') }}" class="btn btn-primary">Edit Profile</a>
                    <button type="button" data-close="modal" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
        @endif
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Automatically show the modal if the profile is incomplete
            const isProfileIncomplete = {{ json_encode($isProfileIncomplete) }};
            if (isProfileIncomplete == true) {
                const modal = document.getElementById('profileIncompleteModal');
                if (modal) {
                    modal.style.display = 'flex';
                }

                // Close modal functionality
                const closeButtons = modal.querySelectorAll('[data-close="modal"]');
                closeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        modal.style.display = 'none';
                    });
                });
            }
        });
        </script>

        <div class="row" class="hero-section d-flex align-items-center" style="background-image: url({{ asset('img/stockImg4.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center; height: 650px;">
            <!-- Left Section -->
            <div class="col-md-4 px-5">
                <!-- Upper Part -->
                <div class="container pt-5">
                    <h1 class="display-4" style="color: #FFFF; font-size: 50px; font-weight: bold; margin-bottom: -10px;">Welcome</h1>
                    <h1 style="color: #F39634; font-size: 70px; font-weight: bold;">Farmer!</h1>
                    <p class="text-light">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <button class="btn btn-warning">Learn More</button>
                </div>
                <!-- User Status -->
                <div class="row text-center px-3 mt-5">
                    <div class="row p-0 m-0">
                        <h1 class="custom-border-top py-2 m-0">Farmers Status</h1>
                        <div class="row custom-border-bottom py-3 m-0">
                            <div class="col">
                                <h5>Active</h5>
                                <h5>XXX</h5>
                            </div>
                            <div class="col m-0 p-0">
                                <h1>|</h1>
                            </div>
                            <div class="col">
                                <h5>Inactive</h5>
                                <h5>XXX</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle Section-->
            <div class="col-md-3 text-center" style="color: white;">
                <div class="container mt-4 p-2" style="background-color: rgba(0, 0, 0, 0.3); border-radius: 15px; width: 90%;">
                    <div class="row">
                        <p class="card-text" id="day" style="font-weight: bold; font-size: 45px;"></p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="weather" class="">
                                <i id="weatherIcon" class="me-3" style="font-size: 100px;"></i> <!-- Change the value here -->
                            </div>
                        </div>

                        <div class="col">
                            <p id="weatherText" class="mb-0" style="font-size: 25px;"></p>
                            <p id="temperature" style="font-size: 2em;"></p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Right Section-->
            <div class="col-md-5 px-5" style="color: white;">
                <!-- Best Seller -->
                <div class="row my-4">
                    <div class="row text-center d-flex mx-auto custom-border-top">
                        <h2 class="my-2">Best Selling This Month</h2>
                    </div>
                    <div class="row text-center d-flex mx-auto py-3 custom-border-bottom">
                        <div class="col">
                            <h4 style="position: absolute;">1st</h4>
                            <img src="https://via.placeholder.com/125x125" alt="Custom Placeholder" width="125" height="125">
                            <h4>Apple</h4>
                            <h5>Amount: 500kg</h5>
                        </div>
                        <div class="col">
                            <h4 style="position: absolute;">2nd</h4>
                            <img src="https://via.placeholder.com/125x125" alt="Custom Placeholder" width="125" height="125">
                            <h4>Mango</h4>
                            <h5>Amount: 300kg</h5>
                        </div>
                        <div class="col">
                            <h4 style="position: absolute;">3rd</h4>
                            <img src="https://via.placeholder.com/125x125" alt="Custom Placeholder" width="125" height="125">
                            <h4>Banana</h4>
                            <h5>Amount: 200kg</h5>
                        </div>
                    </div>
                </div>

                <!-- Bar Graph -->
                <div class="row" style="background-color: #FFFFFF;">
                    <canvas id="myBarChart" style="max-width: 600px;"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        // Using Moment.js to get and format today's day
        var today = moment().format('dddd').toUpperCase();  // 'dddd' gives the full day name
        $('#day').text(today);
    });
</script>

<!-- Weather -->
<script>
    const apiKey = '{{ config('services.weather.key') }}';
    const city = 'Legaspi, PH';
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const weatherElement = document.getElementById('weatherText');
            const weatherIcon = document.getElementById('weatherIcon');
            const temperatureElement = document.getElementById('temperature');
            const weatherCondition = data.weather[0].main.toLowerCase();
            const temperature = data.main.temp.toFixed(1); // Get temperature and round to 1 decimal place

            // Set temperature text
            temperatureElement.textContent = `${temperature}°C`;

            // Set weather condition and icon
            if (weatherCondition.includes('rain')) {
                weatherElement.textContent = "It's rainy!";
                weatherIcon.className = "fas fa-cloud-showers-heavy rainy";
            } else if (weatherCondition.includes('clear')) {
                weatherElement.textContent = "It's sunny!";
                weatherIcon.className = "fas fa-sun sunny";
            } else if (weatherCondition.includes('clouds')) {
                weatherElement.textContent = "It's cloudy!";
                weatherIcon.className = "fas fa-cloud cloudy";
            } else {
                weatherElement.textContent = "Weather is mixed!";
                weatherIcon.className = "fas fa-cloud-sun";
            }
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            document.getElementById('weatherText').textContent = "Unable to fetch weather data.";
            document.getElementById('temperature').textContent = "";
        });

</script>
<script>
    // Sample Data
    const ctx = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'This Month’s Top Consumer Vote',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    function closePopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.error-popup');

        // Add the hidden class to trigger the fade-out animation
        overlay.classList.add('hidden');
        popup.classList.add('hidden');

        // After animation ends, hide the elements entirely
        setTimeout(() => {
            overlay.style.display = 'none';
            popup.style.display = 'none';
        }, 300); // Match the duration of the animation
    }

    function showPopup() {
        const overlay = document.getElementById('overlay');
        const popup = document.querySelector('.error-popup');

        // Show elements and remove hidden class for fade-in animation
        overlay.style.display = 'block';
        popup.style.display = 'block';
        overlay.classList.remove('hidden');
        popup.classList.remove('hidden');
    }
</script>

<script>
    window.addEventListener('popstate', function(event) {
        // If the user press the back button, log them out
        window.location.href = "{{ route('user.logout') }}";
    });
  </script>
@endsection
